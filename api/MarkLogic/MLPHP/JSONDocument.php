<?php
/*
Copyright 2002-2012 MarkLogic Corporation.  All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
namespace MarkLogic\MLPHP;

/**
 * Represents a JSON document.
 *
 * @package MLPHP
 * @author Mike Wooldridge <mike.wooldridge@marklogic.com>
 */
class JSONDocument extends Document
{
    /**
     * Create a JSON document object.
     *
     * @param RESTClient $restClient A REST client object.
     * @param string $uri A document URI.
     */
    public function __construct($restClient, $uri = null)
    {
        parent::__construct($restClient, $uri);
        $this->setContentType('application/json');
    }

    /**
     * Read a JSON document from the database.
     *
     * @param string $uri A document URI.
     * @param array $params Optional additional parameters to pass when reading.
     * @return string The document content.
     */
    public function read($uri = null, $params = array())
    {
        $this->uri = (isset($uri)) ? (string)$uri : $this->uri;
        $params = array_merge(array('format' => 'json'), $params);
        return parent::read($this->uri, $params);
    }

    /**
     * Write a JSON document to the database.
     *
     * @param string $uri A document URI.
     * @param array $params Optional additional parameters to pass when writing.
     * @return Document $this
     */
    public function write($uri = null, $params = array())
    {
        $this->uri = (isset($uri)) ? (string)$uri : $this->uri;
        $params = array_merge(array('format' => 'json'), $params);
        return parent::write($this->uri, $params);
    }

    /**
     * Get the document as a PHP object.
     *
     * @return Object A PHP object.
     */
    public function getAsObject()
    {
        return json_decode($this->getContent(), false);
    }

    /**
     * Get the document as a PHP associative array.
     *
     * @return array An associative array.
     */
    public function getAsArray()
    {
        return json_decode($this->getContent(), true);
    }
}
