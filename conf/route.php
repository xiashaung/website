<?php
$route['test'] =  new Yaf_Route_Rewrite('test/:name',['controller'=>'index','action'=>'test']);
$route['admin/index'] =  new Yaf_Route_Rewrite('admin/index',['controller'=>'index','action'=>'index']);
return $route;