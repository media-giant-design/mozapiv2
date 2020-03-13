<?php

/** Moz API v2 - PHP Library
 *  ================================================================================
 *  PHP library to wrap the moz v2 api in PHP. All functions described at request a bunch of SEO-relevant metrics, such as looking up the
 *  visibilty of a URL within organic search results, Pagespeed analysis, the
 *  Google Toolbar PageRank, Page-Authority, Backlink-Details, Traffic Statistics,
 *  social media relevance, comparing competing websites and a lot more.
 *  ================================================================================
 *  @package     MozAPIv2-PHP
 *  @author      Rick Simnett <rick@mediagiantdesign.com>
 *  @copyright   Copyright (c) 2020 - present Rick Simnett
 *  @license     http://mit-license.org
 *  @version     1.0
 *  @link        https://github.com/media-giant-design/mozapiv2/
 *  @website     https://www.mediagiantdesign.com/
 *  ================================================================================
 *  LICENSE: Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the "Software'),
 *  to deal in the Software without restriction, including without limitation the
 *  rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *
 *    The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY
 *  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *  ================================================================================
 */

class Moz {

    private $endpoint_url = "https://lsapi.seomoz.com/v2";
    private $access_id = null;
    private $secret = null;
    
    /*
     * construct
     * prepares the object for execution
     * 
     * @params $access string
     * @params $secret string
     * @return object
     */
    
    function __construct($access_id,$secret)
    {
        $this->access_id = $access_id;
        $this->secret = $secret;
    }
    
    
    /*
     * anchorText
     * Get metrics about anchor text used by followed external links to a target. Results are ordered by 'external_root_domains' descending.
     * 
     * @param $target string
     * @param $scope string
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    public function anchorText($target,$scope="page",$limit = 50,$next_token=null) {
        $requestUrl = $this->endpoint_url . "/anchor_text";
        
        $data["target"] = $target;
        $data["scope"] = $scope;
        
        $data["limit"] = $limit;
        
        if ($next_token !== null)
            $data['next_token'] = $next_token;
        
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
        
    }
    
    /*
     * finalRedirect
     * Returns the final redirect target of a page after following known redirects in the index. If no redirects are known, returns an empty response.
     * 
     * @param $page string
     * @return object
     */
    
    public function finalRedirect($page) {
        
        $requestUrl = $this->endpoint_url . "/final_redirect";
      
        $data['page'] = $page;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * globalTopPages
     * Returns the top 500 pages in the entire index with the highest page authority values, sorted by page authority.
     * 
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    
    public function globalTopPages($limit = 50,$nextToken = null) {
        $requestUrl = $this->endpoint_url . "/global_top_pages";
       
        $data['limit'] = $limit;
        
        if ($nextToken !== null)
            $data['next_token'] = $nextToken;
        
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * globalTopRootDomains
     * Returns the top 500 root domains in the entire index with the highest domain authority values, sorted by domain authority.
     * 
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    public function globalTopRootDomains($limit = 50,$nextToken = null) {
        $requestUrl = $this->endpoint_url . "/global_top_root_domains";
       
        $data['limit'] = $limit;
        
        if ($nextToken !== null)
            $data['next_token'] = $nextToken;
        
       
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * indexMetaData
     * Returns an id that changes when the data in the index changes.
     * 
     * @return object
     */
    
    public function indexMetaData() {
        $requestUrl = $this->endpoint_url . "/index_metadata";
       
        return json_decode($this->file_post_contents($requestUrl,"{}"));
    }
    
    /*
     * linkIntersect
     * Get sources that link to at least one of a list of positive targets and don't link to any of a list of negative targets.
     * Please note: This is a weighted endpoint which means that data returned from this endpoint will count as more than 1 row consumed when data is requested. Please see here for more information on weighted endpoints.
     * 
     * @param $positiveTargets array
     * @param $negativeTargets array
     * @param $min_matching_targets number
     * @param $source_scope string
     * @param $sort string
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    public function linkIntersect($positiveTargets, $negativeTargets = [], $min_matching_targets = null, $source_scope = "page", $sort = null, $limit = 50) {
        $requestUrl = $this->endpoint_url . "/link_intersect";
        
        $data['positive_targets'] = $positiveTargets;
        $data["negative_targets"] = $negativeTargets;
        
        if ($min_matching_targets !== null)
            $data["min_matching_targets"] = $min_matching_targets;
        
        $data["source_scope"] = $source_scope;
        
        $data["sort"] = $sort;
        $data["limit"] = $limit;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * linkStatus
     * Get information about links from many sources to a single target
     * Please note: This is a weighted endpoint which means that data returned from this endpoint will count as more than 1 row consumed when data is requested. Please see here for more information on weighted endpoints.* 
     * 
     * @param $sources array
     * @param $target string
     * @param $target_scope string
     * @param $source_scope string
     * @return object
     */
    
    
    public function linkStatus($sources,$target,$target_scope="page",$source_scope="page") {
        $requestUrl = $this->endpoint_url . "/link_status";
        
        $data['sources'] = $sources;
        $data["target"] = $target;
        $data["target_scope"] = $target_scope;
        $data["source_scope"] = $source_scope;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * linkingRootDomains
     * Get linking root domains to a target
     * 
     * @param $target string
     * @param $target_scope string
     * @param $sort string
     * @param $filter string
     * @param $begin_date string
     * @param $end_date string
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    public function linkingRootDomains($target,$target_scope="page",$sort="source_domain_authority",$filter = "external",$begin_date = null,$end_date = null,$limit = 50,$next_token=null) {
        $requestUrl = $this->endpoint_url . "/linking_root_domains";
        
        $data["target"] = $target;
        $data["target_scope"] = $target_scope;
        
        if ($sort !== null)
            $data["sort"] = $sort;
        
        $data["filter"] = $filter;
        
        if ($begin_date !== null)
            $data["begin_date"] = $begin_date;
        
        if ($end_date !== null)
            $data["end_date"] = $end_date;
        
        $data["limit"] = $limit;
        
        if ($next_token !== null)
            $data['next_token'] = $next_token;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
        
    }
    
    /*
     * linkingRootDomains
     * Get linking root domains to a target
     * 
     * @param $target string
     * @param $target_scope string
     * @param $sort string
     * @param $filter string
     * @param $anchor_text string
     * @param $source_root_domain string
     * @param $source_scope string
     * @param $subdomains_limited_to_one array
     * @param $limit int
     * @param $next_token string
     * @return object
     */
    
    
    public function linkMetrics($target,$scope="subdomain",$sort=null,$filter = "all",$anchor_text = null,$source_root_domain = null,$source_scope = null,$subdomains_limited_to_one = [],$limit = 50,$next_token=null) {
        //retrieve a list of all the backlinks to a domain or page
        
        $requestUrl = $this->endpoint_url . "/links";
        
        $data["target"] = $target;
        $data["target_scope"] = $scope;
        
        if ($sort !== null)
            $data["sort"] = $sort;
        
        $data["filter"] = $filter;
        $data["anchor_text"] = $anchor_text;
        $data["source_root_domain"] = $source_root_domain;
        $data["source_scope"] = $source_scope;
        $data["subdomains_limited_to_one"] =  $subdomains_limited_to_one;      
        $data["limit"] = $limit;
        
        if ($next_token !== null)
            $data['next_token'] = $next_token;
        
        var_dump($data);
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }
    
    /*
     * topPages
     * Get linking root domains to a target
     * 
     * @param $target string
     * @param $scope string
     * @param $sort string
     * @param $filter string
     * @param $daily_history_deltas array
     * @param $daily_history_values array
     * @param $monthly_history_deltas array
     * @param $monthly_history_values array
     * @param $limit int
     * @param $next_token string
     * @return object
     */

    public function topPages($target,$scope="subdomain",$sort="page_authority",$filter = "all",$daily_history_deltas = [],$daily_history_values = [],$monthly_history_deltas = [],$monthly_history_values = [],$limit = 50,$next_token=null) {
        //get a list of the top pages for the domain
        $requestUrl = $this->endpoint_url . "/top_pages";
        
        $data["target"] = $target;
        $data["scope"] = $scope;
        $data["sort"] = $sort;
        $data["filter"] = $filter;
        $data["daily_history_deltas"] = $daily_history_deltas;
        $data["daily_history_values"] = $daily_history_values;
        $data["monthly_history_deltas"] = $monthly_history_deltas;
        $data["monthly_history_values"] =  $monthly_history_values;      
        $data["limit"] = $limit;
        
        if ($next_token !== null)
            $data['next_token'] = $next_token;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    }

    /*
     * urlMetrics
     * Get metrics about one or more urls.
     * Please note: This is a weighted endpoint which means that data returned from this endpoint may count as more than 1 row consumed based on the data requested. Please see here for more information on weighted endpoints and multiplier logic specific to the URL Metrics endpoint.
     * 
     * @param $targets array
     * @param $daily_history_deltas array
     * @param $daily_history_values array
     * @param $monthly_history_deltas array
     * @param $monthly_history_values array
     * @param $distributions boolean
     * @return object
     */

    public function urlMetrics($targets,$daily_history_deltas = [],$daily_history_values = [],$monthly_history_deltas = [],$monthly_history_values = [],$distributions = false) {
        //get the url metrics for the domain
        $requestUrl = $this->endpoint_url . "/url_metrics";

        $data["targets"] = $targets;
        $data["daily_history_deltas"] = $daily_history_deltas;
        $data["daily_history_values"] = $daily_history_values;
        $data["monthly_history_deltas"] = $monthly_history_deltas;
        $data["monthly_history_values"] =  $monthly_history_values;      
        $data["distributions"] = $distributions;
        
        return json_decode($this->file_post_contents($requestUrl,json_encode($data)));
    } 
    
    /*
     * usageData
     * Returns the number of rows consumed so far in the current billing period.
     * The count returned might not reflect rows consumed in the last hour.
     * The count returned reflects rows consumed by requests to both the v1 (Mozscape) and v2 Links APIs.
     * 
     * @return object
     */
    
    public function usageData() {
        $requestUrl = $this->endpoint_url . "/usage_data";
       
        return json_decode($this->file_post_contents($requestUrl,"{}"));
    }
    
    /*
     * file_post_contents
     * Generates the authentication and triggers the JSON POST request to the api.
     *
     * @params $url string
     * @params $data json encoded string 
     * @return object
     */
    
    private function file_post_contents($url, $data) {
    
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                ("Authorization: Basic " . base64_encode($this->access_id . ":" . $this->secret)),
                'content-length' => strlen($data),
                'content' => $data,
            )
        );

        $context = stream_context_create($opts);
        
        return file_get_contents($url, false, $context);
    }

}
