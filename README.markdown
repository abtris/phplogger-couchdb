README
------

CouchDB Log Writer for Zend Framework

For logs are nosql database is better than RBMS.

- map functions (all log messages)


        function(doc) {
          emit(doc.priorityName,[doc.timestamp,doc.message]);
        }

- map function by priorityName (save as log_by_prior)


        function(doc) {
          if (doc.priority) {
             emit(doc.priority, [doc.priorityName, doc.timestamp, doc.message]);
          }
        }

-  call by using


        http://127.0.0.1:5984/test-log/_design/log_by_prior/_view/log_by_prior/?key=%22ERR%22

- or using PHP

    in controller

        $db = new Phly_Couch(array("db"=>"test-log", "host"=>"localhost", "port"=>"5984"));
        $result = $db->view('log_by_prior','log_by_prior', "ERR", array("db"=>"test-log"));
        $this->view->docs = $result->toArray();
        
    and view

        echo "<table id='logger'>";
        echo "<tr>";
        echo "<th>Priority Name</th>";
        echo "<th>Timestamp</th>";
        echo "<th>Message</th>";
        echo "</tr>";
        foreach ($this->docs['docs'] as $doc) {
            echo "<tr>";
            echo "<td class='key'>".$doc['key']."</td>";
            foreach ($doc['value'] as $val) {
                echo "<td>".$val."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";