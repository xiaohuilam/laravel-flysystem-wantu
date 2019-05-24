<?php
namespace XiaohuiLam\LaravelFilesystem\Wantu;

use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Adapter\Polyfill\NotSupportingVisibilityTrait;
use AliMedia\AlibabaImage as Client;
use AliMedia\Utils\UploadPolicy;
use League\Flysystem\Config;
use Illuminate\Support\Str;

class WantuFileAdapter extends AbstractAdapter
{
    use NotSupportingVisibilityTrait;

    /**
     * @var Client|null
     */
    private $client = null;

    /**
     * @var string
     */
    private $namespace = null;

    public function setClient(Client $client, $namespace)
    {
        $this->client = $client;
        $this->namespace = $namespace;
    }

    /**
     * Write a new file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function write($path, $contents, Config $config)
    {
        $uploadPolicy = new UploadPolicy($this->namespace, preg_replace('/^\./', '', dirname($path)), last(explode("\\", $path)));
        return $this->client->uploadData($contents, $uploadPolicy);
    }

    /**
     * Write a new file using a stream.
     *
     * @param string   $path
     * @param resource $resource
     * @param Config   $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function writeStream($path, $resource, Config $config)
    {
    }

    /**
     * Update a file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function update($path, $contents, Config $config)
    {
    }

    /**
     * Update a file using a stream.
     *
     * @param string   $path
     * @param resource $resource
     * @param Config   $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function updateStream($path, $resource, Config $config)
    {
    }

    /**
     * Rename a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function rename($path, $newpath)
    {
        return $this->client->renameFile($this->namespace, preg_replace('/^\./', '', dirname($path)), last(explode("\\", $path)), preg_replace('/^\./', '', dirname($newpath)), last(explode("\\", $newpath)));
    }

    /**
     * Copy a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function copy($path, $newpath)
    {
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @return bool
     */
    public function delete($path)
    {
        return $this->client->deleteFile($this->namespace, preg_replace('/^\./', '', dirname($path)), last(explode("\\", $path)));
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @return bool
     */
    public function deleteDir($dirname)
    {
        return $this->client->deleteDir($this->namespace, $dirname);
    }

    /**
     * Create a directory.
     *
     * @param string $dirname directory name
     * @param Config $config
     *
     * @return array|false
     */
    public function createDir($dirname, Config $config)
    {
        return $this->client->createDir($this->namespace, $dirname);
    }

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return array|bool|null
     */
    public function has($path)
    {
        if (Str::endsWith($path, "/")) {
            return $this->client->existsFolder($this->namespace,  preg_replace('/^\./' , '', dirname( $path)));
        } else {
            return $this->client->existsFile($this->namespace, preg_replace('/^\./', '', dirname($path)), last(explode("\\", $path)));
        }
    }

    /**
     * Read a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function read($path)
    {
    }

    /**
     * Read a file as a stream.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function readStream($path)
    {
    }

    /**
     * List contents of a directory.
     *
     * @param string $directory
     * @param bool   $recursive
     *
     * @return array
     */
    public function listContents($directory = '', $recursive = false)
    {
        return $this->client->listFiles($this->namespace, $directory, 1, 1000);
    }

    /**
     * Get all the meta data of a file or directory.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMetadata($path)
    {
        return $this->client->getFileInfo($path);
    }

    /**
     * Get the size of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getSize($path)
    {
    }


    /**
     * Fetch url to bucket.
     *
     * @param string $path
     * @param string $url
     *
     * @return array|false
     */
    public function fetch($path, $url)
    {
    }

    /**
     * Get private file download url.
     *
     * @param string $path
     * @param int    $expires
     *
     * @return string
     */
    public function privateDownloadUrl($path, $expires = 3600)
    {
    }

    /**
     * Refresh file cache.
     *
     * @param string|array $path
     *
     * @return array
     */
    public function refresh($path)
    {
    }


    /**
     * Get the mime-type of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMimeType($path)
    {
    }


    /**
     * Get the timestamp of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getTimestamp($path)
    {
    }


    /**
     * @param \Qiniu\Storage\BucketManager $manager
     *
     * @return $this
     */
    public function setBucketManager(BucketManager $manager)
    {
    }


    /**
     * @param \Qiniu\Storage\UploadManager $manager
     *
     * @return $this
     */
    public function setUploadManager(UploadManager $manager)
    {
    }


    /**
     * @param \Qiniu\Auth $manager
     *
     * @return $this
     */
    public function setAuthManager(Auth $manager)
    {
    }

    /**
     * @param CdnManager $manager
     *
     * @return $this
     */
    public function setCdnManager(CdnManager $manager)
    {
    }


    /**
     * @return \Qiniu\Storage\BucketManager
     */
    public function getBucketManager()
    {
        return $this->bucketManager ?: $this->bucketManager = new BucketManager($this->getAuthManager());
    }
    /**
     * @return \Qiniu\Auth
     */
    public function getAuthManager()
    {
        return $this->authManager ?: $this->authManager = new Auth($this->accessKey, $this->secretKey);
    }
    /**
     * @return \Qiniu\Storage\UploadManager
     */
    public function getUploadManager()
    {
        return $this->uploadManager ?: $this->uploadManager = new UploadManager();
    }
    /**
     * @return \Qiniu\Cdn\CdnManager
     */
    public function getCdnManager()
    {
        return $this->cdnManager ?: $this->cdnManager = new CdnManager($this->getAuthManager());
    }
    /**
     * @return string
     */
    public function getBucket()
    {
        return $this->bucket;
    }
    /**
     * Get the upload token.
     *
     * @param string|null $key
     * @param int         $expires
     * @param string|null $policy
     * @param string|null $strictPolice
     *
     * @return string
     */
    public function getUploadToken($key = null, $expires = 3600, $policy = null, $strictPolice = null)
    {
        return $this->getAuthManager()->uploadToken($this->bucket, $key, $expires, $policy, $strictPolice);
    }
    /**
     * @param array $stats
     *
     * @return array
     */
    protected function normalizeFileInfo(array $stats)
    {
        return [
            'type' => 'file',
            'path' => $stats['key'],
            'timestamp' => floor($stats['putTime'] / 10000000),
            'size' => $stats['fsize'],
        ];
    }
    /**
     * @param string $domain
     *
     * @return string
     */
    protected function normalizeHost($domain)
    {
        if (0 !== stripos($domain, 'https://') && 0 !== stripos($domain, 'http://')) {
            $domain = "http://{$domain}";
        }
        return rtrim($domain, '/') . '/';
    }
}
