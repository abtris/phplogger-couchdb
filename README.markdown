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
          if (doc.priorityName) {
             emit(doc.priorityName, [doc.timestamp, doc.message]);
          }
        }

-  call by using


    http://127.0.0.1:5984/test-log/_design/log_by_prior/_view/log_by_prior/?key=%22ERR%22