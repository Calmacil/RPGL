RPGL
====

PHP base library / framework to write and manage RPG character sheets applications


#Configuration

See in config/config.json

* db:
  * type
  * host
  * dbname
  * user
  * password
  * path


##Routing

see in config/routes.json

    {
        "route_name" : {
            "pattern" : "standard/regexp/without/trailing/slash"
            "params" : {
                "param_name" : "default_value" // Empty string means no default
            },
            "controller" : "Path/To/Controller",
            "action" : "function_name"
    }
