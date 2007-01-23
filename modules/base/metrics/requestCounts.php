<?php

//
// Open Web Analytics - An Open Source Web Analytics Framework
//
// Copyright 2006 Peter Adams. All rights reserved.
//
// Licensed under GPL v2.0 http://www.gnu.org/copyleft/gpl.html
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
// $Id$
//

require_once(OWA_BASE_DIR.DIRECTORY_SEPARATOR.'owa_metric.php');

/**
 * Dashboard Core metrics By Day
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */

class owa_requestCounts extends owa_metric {
	
	function owa_requestCounts($params = null) {
		
		$this->params = $params;
		
		$this->owa_metric();
		
		return;
		
	}
	
	function generate() {
		
		$this->params['select'] = "count(distinct request.visitor_id) as unique_visitors, 
									count(request.session_id) as sessions, 
									count(request.id) as page_views";
		
		// $this->params['use_summary'] = true;
		
		$this->params['result_format'] = 'single_array';
		
		$this->setTimePeriod($this->params['period']);
		
		$r = owa_coreAPI::entityFactory('base.request');
		
		return $r->query($this->params);
		
		/*
		 
		 $sql = sprintf("
		SELECT 
			count(distinct requests.visitor_id) as unique_visitors, 
			count(requests.session_id) as sessions, 
			count(requests.request_id) as page_views 
		FROM 
			%s as requests
		
		WHERE 
			true
			%s 
			%s
			",
			$this->setTable($this->config['requests_table']),
			$this->time_period($this->params['period']),
			$this->add_constraints($this->params['constraints'])
		);
	
		return $this->db->get_row($sql);
		 
		 
		 
		 */
		
	}
	
	
}


?>