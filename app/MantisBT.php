<?php


namespace app;

use app\GetRequest;
use app\PostRequest;
use WHMCS\Database\Capsule;

class MantisBT
{
    const METHOD_POST = "POST";
    const METHOD_GET = "GET";

    /**
     * @var GetRequest
     * @var PostRequest
     */
    private $request;

    /**
     * @var array
     */
    public $params;

    /**
     * @var array
     */
    private $data;

    /**
     * MantisBT constructor.
     */
    public function __construct()
    {
        $this->data['url'] = getenv('MANTIS_URL');
        $this->data['token'] = getenv('MANTIS_TOKEN');
    }

    /**
     * @param $method
     */
    public function prepare($method)
    {
        if ($method == static::METHOD_GET) {
            $this->request = new GetRequest();
        }

        if ($method == static::METHOD_POST) {
            $this->request = new PostRequest();
        }
    }

    /**
     * Get all issues for the specified project.
     *
     * @return mixed
     */
    public function getIssuesForProject($pid)
    {
        $this->prepare(static::METHOD_GET);

        $this->data['endpoint'] = '/api/rest/issues';
        $this->data['params'] = ['project_id' => $pid];

        return $this->request->call($this->data);
    }

    /**
     * Get issue with the specified id.
     *
     * @param $id
     * @return mixed
     */
    public function getIssue($id)
    {
        $this->prepare(static::METHOD_GET);

        $this->data['endpoint'] = '/api/rest/issues';
        $this->data['params'] = $id;

        return $this->request->call($this->data);
    }

    /**
     * @return mixed
     */
    public function createIssue($params)
    {
        $this->prepare(static::METHOD_POST);

        $this->data['endpoint'] = '/api/rest/issues';

        $this->data['params'] = $params;

        return $this->request->call($this->data);
    }
}