<?php

namespace League\Flysystem;

use BadMethodCallException;
use InvalidArgumentException;
use League\Flysystem\Plugin\PluggableTrait;
use League\Flysystem\Plugin\PluginNotFoundException;

/**
 * @method array getWithMetadata(string $path, array $metadata)
 * @method array listFiles(string $path = '', boolean $recursive = false)
 * @method array listPaths(string $path = '', boolean $recursive = false)
 * @method array listWith(array $keys = [], $directory = '', $recursive = false)
 */
class Filesystem implements FilesystemInterface
{
    use PluggableTrait;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @param Config|array     $config
     */
    public function __construct(AdapterInterface $adapter, $config = null)
    {
        $this->adapter = $adapter;
        $this->config = Util::ensureConfig($config);
    }

    /**
     * Get the Adapter.
     *
     * @return AdapterInterface adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Get the Config.
     *
     * @return Config config object
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     */
    public function has($path)
    {
        $path = Util::normalizePath($path);

        return (bool) $this->getAdapter()->has($path);
    }

    /**
     * {@inheritdoc}
     */
    public function write($path, $contents, array $config = [])
    {
        $path = Util::normalizePath($path);
        $this->assertAbsent($path);
        $config = $this->prepareConfig($config);

        return (bool) $this->getAdapter()->write($path, $contents, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function writeStream($path, $resource, array $config = [])
    {
        if (! is_resource($resource)) {
            throw new InvalidArgumentException(__METHOD__.' expects argument #2 to be a valid resource.');
        }

        $path = Util::normalizePath($path);
        $this->assertAbsent($path);
        $config = $this->prepareConfig($config);

        Util::rewindStream($resource);

        return (bool) $this->getAdapter()->writeStream($path, $resource, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function put($path, $contents, array $config = [])
    {
        $path = Util::normalizePath($path);
        $config = $this->prepareConfig($config);

        if ($this->has($path)) {
            return (bool) $this->getAdapter()->update($path, $contents, $config);
        }

        return (bool) $this->getAdapter()->write($path, $contents, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function putStream($path, $resource, array $config = [])
    {
        if (! is_resource($resource)) {
            throw new InvalidArgumentException(__METHOD__.' expects argument #2 to be a valid resource.');
        }

        $path = Util::normalizePath($path);
        $config = $this->prepareConfig($config);
        Util::rewindStream($resource);

        if ($this->has($path)) {
            return (bool) $this->getAdapter()->updateStream($path, $resource, $config);
        }

        return (bool) $this->getAdapter()->writeStream($path, $resource, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function readAndDelete($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);
        $contents = $this->read($path);

        if ($contents === false) {
            return false;
        }

        $this->delete($path);

        return $contents;
    }

    /**
     * {@inheritdoc}
     */
    public function update($path, $contents, array $config = [])
    {
        $path = Util::normalizePath($path);
        $config = $this->prepareConfig($config);

        $this->assertPresent($path);

        return (bool) $this->getAdapter()->update($path, $contents, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function updateStream($path, $resource, array $config = [])
    {
        if (! is_resource($resource)) {
            throw new InvalidArgumentException(__METHOD__.' expects argument #2 to be a valid resource.');
        }

        $path = Util::normalizePath($path);
        $config = $this->prepareConfig($config);
        $this->assertPresent($path);
        Util::rewindStream($resource);

        return (bool) $this->getAdapter()->updateStream($path, $resource, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function read($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        if (! ($object = $this->getAdapter()->read($path))) {
            return false;
        }

        return $object['contents'];
    }

    /**
     * {@inheritdoc}
     */
    public function readStream($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        if (! $object = $this->getAdapter()->readStream($path)) {
            return false;
        }

        return $object['stream'];
    }

    /**
     * {@inheritdoc}
     */
    public function rename($path, $newpath)
    {
        $path = Util::normalizePath($path);
        $newpath = Util::normalizePath($newpath);
        $this->assertPresent($path);
        $this->assertAbsent($newpath);

        return (bool) $this->getAdapter()->rename($path, $newpath);
    }

    /**
     * {@inheritdoc}
     */
    public function copy($path, $newpath)
    {
        $path = Util::normalizePath($path);
        $newpath = Util::normalizePath($newpath);
        $this->assertPresent($path);
        $this->assertAbsent($newpath);

        return $this->getAdapter()->copy($path, $newpath);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        return $this->getAdapter()->delete($path);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteDir($dirname)
    {
        $dirname = Util::normalizePath($dirname);

        if ($dirname === '') {
            throw new RootViolationException('Root directories can not be deleted.');
        }

        return (bool) $this->getAdapter()->deleteDir($dirname);
    }

    /**
     * {@inheritdoc}
     */
    public function createDir($dirname, array $config = [])
    {
        $dirname = Util::normalizePath($dirname);
        $config = $this->prepareConfig($config);

        return (bool) $this->getAdapter()->createDir($dirname, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function listContents($directory = '', $recursive = false)
    {
        $directory = Util::normalizePath($directory);
        $contents = $this->getAdapter()->listContents($directory, $recursive);
        $mapper = function ($entry) use ($directory, $recursive) {
            $entry = $entry + Util::pathinfo($entry['path']);

            if (! empty($directory) && strpos($entry['path'], $directory) === false) {
                return false;
            }

            if ($recursive === false && Util::dirname($entry['path']) !== $directory) {
                return false;
            }

            return $entry;
        };

        return array_values(array_filter(array_map($mapper, $contents)));
    }

    /**
     * {@inheritdoc}
     */
    public function getMimetype($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        if (! $object = $this->getAdapter()->getMimetype($path)) {
            return false;
        }

        return $object['mimetype'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        if (! $object = $this->getAdapter()->getTimestamp($path)) {
            return false;
        }

        return $object['timestamp'];
    }

    /**
     * {@inheritdoc}
     */
    public function getVisibility($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        if (($object = $this->getAdapter()->getVisibility($path)) === false) {
            return false;
        }

        return $object['visibility'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSize($path)
    {
        $path = Util::normalizePath($path);

        if (($object = $this->getAdapter()->getSize($path)) === false || !isset($object['size'])) {
            return false;
        }

        return (int) $object['size'];
    }

    /**
     * {@inheritdoc}
     */
    public function setVisibility($path, $visibility)
    {
        $path = Util::normalizePath($path);

        return (bool) $this->getAdapter()->setVisibility($path, $visibility);
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadata($path)
    {
        $path = Util::normalizePath($path);
        $this->assertPresent($path);

        return $this->getAdapter()->getMetadata($path);
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, Handler $handler = null)
    {
        $path = Util::normalizePath($path);

        if (! $handler) {
            $metadata = $this->getMetadata($path);
            $handler = $metadata['type'] === 'file' ? new File($this, $path) : new Directory($this, $path);
        }

        $handler->setPath($path);
        $handler->setFilesystem($this);

        return $handler;
    }

    /**
     * Convert a config array to a Config object with the correct fallback.
     *
     * @param array $config
     *
     * @return Config
     */
    protected function prepareConfig(array $config)
    {
        $config = new Config($config);
        $config->setFallback($this->config);

        return $config;
    }

    /**
     * Assert a file is present.
     *
     * @param string $path path to file
     *
     * @throws FileNotFoundException
     */
    public function assertPresent($path)
    {
        if (! $this->has($path)) {
            throw new FileNotFoundException($path);
        }
    }

    /**
     * Assert a file is absent.
     *
     * @param string $path path to file
     *
     * @throws FileExistsException
     */
    public function assertAbsent($path)
    {
        if ($this->has($path)) {
            throw new FileExistsException($path);
        }
    }

    /**
     * Plugins pass-through.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @throws BadMethodCallException
     *
     * @return mixed
     */
    public function __call($method, array $arguments)
    {
        try {
            return $this->invokePlugin($method, $arguments, $this);
        } catch (PluginNotFoundException $e) {
            throw new BadMethodCallException(
                'Call to undefined method '
                .__CLASS__
                .'::'.$method
            );
        }
    }
}
