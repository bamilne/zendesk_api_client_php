<?php

namespace Zendesk\API\Resources;

use Zendesk\API\Exceptions\CustomException;

/**
 * The Tags class exposes methods as detailed on http://developer.zendesk.com/documentation/rest_api/tags.html
 *
 * @package Zendesk\API
 */
class Tags extends ResourceAbstract
{

    const OBJ_NAME = 'tags';
    const OBJ_NAME_PLURAL = 'tags';

    /**
     * Returns a route and replaces tokenized parts of the string with
     * the passed params
     *
     * @param       $name
     * @param array $params
     *
     * @return mixed Any of the following formats based on the parent chain
     *              tickets/{id}/tags.json
     *              topics/{id}/tags.json
     *              organizations/{id}/tags.json
     *              users/{id}/tags.json
     *
     * @throws \Exception
     */
    public function getRoute($name, array $params = array())
    {
        if (!in_array($name, array('update', 'find', 'create', 'delete'))) {
            return parent::getRoute($name, $params);
        }

        $chainedParameters = $this->getChainedParameters();

        if (count($chainedParameters) == 0) {
            throw new CustomException('The ' . $name . '() method needs to be called while chaining.');
        }

        $chainedResourceNames = array_keys($chainedParameters);

        $id = reset($chainedParameters);
        $resource = $chainedResourceNames[0]::OBJ_NAME_PLURAL;

        return "$resource/$id/tags.json";
    }
}
