<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $modelName = null;
    protected $female = false;

    /**
     * Basic show response with a single Resource
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function showResponse($resource)
    {
        return $this->sendResource(Response::HTTP_OK, $this->getMessage('show'), $resource);
    }

    /**
     * Basic index response with a collection of Resources
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexResponse($resource)
    {
        return $this->sendResource(Response::HTTP_OK, $this->getMessage('index'), $resource);
    }

    /**
     * Basic store response with a single Resource
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeResponse($resource)
    {
        return $this->sendResource(Response::HTTP_CREATED, $this->getMessage('created'), $resource);
    }

    /**
     * Basic update response with a single Resource
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateResponse($resource)
    {
        return $this->sendResource(Response::HTTP_ACCEPTED, $this->getMessage('updated'), $resource);
    }

    /**
     * Basic destroy response. A Resource can be specified
     *
     * @param Model $model
     * @param null $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyResponse(Model $model, $resource = null)
    {
        try {
            $model->delete();
        } catch (\Exception $e) {
            return $this->dataResponse(Response::HTTP_UNPROCESSABLE_ENTITY, trans('session.delete_error'));
        }

        return $resource
            ? $this->sendResource(Response::HTTP_ACCEPTED, $this->getMessage('deleted'), $resource)
            : $this->dataResponse(Response::HTTP_ACCEPTED, $this->getMessage('deleted'));
    }

    /**
     * Builds up a json response using an Api Resource.
     *
     * @param int $code
     * @param string $message
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResource($code, $message, $resource)
    {
        $data = [
            'code' => $code,
            'message' => $message,
        ];

        return $resource->additional($data)
            ->response()
            ->setStatusCode($code);
    }

    /**
     * Builds up a json response that can includes specific data.
     *
     * @param int $code
     * @param string $message
     * @param array|string $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function dataResponse(int $code, string $message, $data = null)
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($data, $code);
    }

    /**
     * Executes 'load()' method on model to get data from relationships.
     * It will look for a 'with' input in request body. $with can be a string or an array
     *
     * @param Request $request
     * @param Model $model
     * @return Model
     */
    protected function loadRelations(Request $request, Model $model)
    {
        try {
            if ($relations = $request->get('with')) {
                if (is_array($relations)) {
                    collect($relations)->each(function ($relation) use ($model) {
                        $model->load(underscoreToCamelCase($relation));
                    });
                } else {
                    $model->load(underscoreToCamelCase($relations));
                }
            }
        } catch (RelationNotFoundException $e) {
            logger($e->getMessage());
        }

        return $model;
    }

    /**
     * Little helper for controller's messages. It will translate based in the modelName and verb passed
     * Model name will be calculated by Controller's name if $modelName() is not defined.
     * If $female is true, it will apply a trans_choice function to select the second option of translate file.
     *
     * @param $verb
     * @return Controller
     */
    protected function getMessage($verb)
    {
        $modelName = $this->modelName ?? $this->getModelName();

        $translatedModel = trans("models.$modelName.$modelName");

        return trans_choice("verbs.$verb", $this->female ? 2 : 1, ['model' => $translatedModel]);
    }

    /**
     * Helper for retrieving Model name. It calculates the model name by the Controller name
     * Controller name must keep naming convention (plural) of models controlled.
     * For modifying ModelName manually, use $this->setModelString()
     *
     * @return string
     */
    private function getModelName()
    {
        // Get the ModelName from Controller's name. AccountingSettingController -> AccountingSetting
        $modelName = str_replace('Controller', '', class_basename($this));

        // Pass to user_score_case. AccountingSetting -> accounting_setting
        $underScore = preg_replace('/(?<=\\w)(?=[A-Z])/', "_$1", $modelName);

        return strtolower($underScore);
    }
}
