<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>

    <meta name="description" content="Shopping Cart">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Store CSRF token for AJAX calls with jquery-->
    <meta name="csrf-token" content="qROImxpKe6r3HVKE4KPjyyA2ijVB5ukuDHPRcn42">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/dropzone.min.css">
    <link rel="stylesheet" href="/css/link.css">
    <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="http://127.0.0.1:8000/vendor/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/css/custom.css">

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="http://127.0.0.1:8000/img/favicon.png">
</head>
    <body>
        <header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://127.0.0.1:8000">Your order</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class=""><a href="http://127.0.0.1:8000/shop">Our Menu</a></li>
                                            <li class="">
                            <a href="http://127.0.0.1:8000/holidays-special">Christmas Specials</a>
                        </li>
                                    </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/contact-us">Contact</a></li>
                                            <li><a href="/login">Sign in</a></li>
                        <li><a href="/register">Register</a></li>
                                    <li class=""><a href="http://127.0.0.1:8000/cart">Cart (0)</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

</header>
        <div class="container" id="app">
                        
    <div class="row">
                
        <div class="panel-body">

            <div class="panel panel-info">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="http://127.0.0.1:8000/login">
                        <input type="hidden" name="_token" value="qROImxpKe6r3HVKE4KPjyyA2ijVB5ukuDHPRcn42">

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <strong>First Name:</strong>
                            </div>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <strong>Password:</strong>
                            </div>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" > Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>


                                <a class="btn btn-link" href="http://127.0.0.1:8000/password/reset">
                                    Forgot Your Password?
                                </a>

                                or
                                <small><a class="text-primary text-right" href="/register">Register</a></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


            <flash message=></flash>
        </div>
        <footer>
    <div class="container">
        <p class="text-muted">Restaurant Name <a href="http://127.0.0.1:8000">Homepage</a></p>
    </div>
</footer>

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/smoothscroll.js" charset="utf-8"></script>

                
    <link rel='stylesheet' type='text/css' property='stylesheet' href='//127.0.0.1:8000/_debugbar/assets/stylesheets?v=1501673736'><script type='text/javascript' src='//127.0.0.1:8000/_debugbar/assets/javascript?v=1501673736'></script><script type="text/javascript">jQuery.noConflict(true);</script>
<script type="text/javascript">
var phpdebugbar = new PhpDebugBar.DebugBar();
phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");
phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));
phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");
phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));
phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));
phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");
phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"database","title":"Queries", "widget": new PhpDebugBar.Widgets.LaravelSQLQueriesWidget()}));
phpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));
phpdebugbar.addTab("auth", new PhpDebugBar.DebugBar.Tab({"icon":"lock","title":"Auth", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addIndicator("auth.name", new PhpDebugBar.DebugBar.Indicator({"icon":"user","tooltip":"Auth status"}), "right");
phpdebugbar.addTab("gate", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Gate", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.setDataMap({
"messages": ["messages.messages", []],
"messages:badge": ["messages.count", null],
"time": ["time.duration_str", '0ms'],
"timeline": ["time", {}],
"memory": ["memory.peak_usage_str", '0B'],
"exceptions": ["exceptions.exceptions", []],
"exceptions:badge": ["exceptions.count", null],
"views": ["views", []],
"views:badge": ["views.nb_templates", 0],
"route": ["route", {}],
"currentroute": ["route.uri", ],
"queries": ["queries", []],
"queries:badge": ["queries.nb_statements", 0],
"emails": ["swiftmailer_mails.mails", []],
"emails:badge": ["swiftmailer_mails.count", null],
"auth": ["auth.guards", {}],
"auth.name": ["auth.names", ],
"gate": ["gate.messages", []],
"gate:badge": ["gate.count", null],
"session": ["session", {}],
"request": ["request", {}]
});
phpdebugbar.restoreState();
phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);
phpdebugbar.ajaxHandler.bindToXHR();
phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\/\/127.0.0.1:8000\/_debugbar\/open"}));
phpdebugbar.addDataSet({"__meta":{"id":"a320866c68dbf08ecdb13c0f4c3d77cc","datetime":"2017-11-30 16:58:40","utime":1512057520.211848,"method":"GET","uri":"\/login","ip":"127.0.0.1"},"php":{"version":"7.1.12","interface":"cli-server"},"messages":{"count":0,"messages":[]},"time":{"start":1512057520.192253,"end":1512057520.211863,"duration":0.019609928131103516,"duration_str":"19.61ms","measures":[{"label":"Booting","start":1512057520.192253,"relative_start":0,"end":1512057520.200212,"relative_end":1512057520.200212,"duration":0.00795888900756836,"duration_str":"7.96ms","params":[],"collector":null},{"label":"Application","start":1512057520.196849,"relative_start":0.00459599494934082,"end":1512057520.211865,"relative_end":1.9073486328125e-6,"duration":0.015015840530395508,"duration_str":"15.02ms","params":[],"collector":null}]},"memory":{"peak_usage":2097152,"peak_usage_str":"2MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":5,"templates":[{"name":"auth.login (resources\/views\/auth\/login.blade.php)","param_count":0,"params":[],"type":"blade"},{"name":"layouts.master (resources\/views\/layouts\/master.blade.php)","param_count":5,"params":["obLevel","__env","app","errors","title"],"type":"blade"},{"name":"includes.header (resources\/views\/includes\/header.blade.php)","param_count":5,"params":["obLevel","__env","app","errors","title"],"type":"blade"},{"name":"messages.messages (resources\/views\/messages\/messages.blade.php)","param_count":5,"params":["obLevel","__env","app","errors","title"],"type":"blade"},{"name":"includes.footer (resources\/views\/includes\/footer.blade.php)","param_count":5,"params":["obLevel","__env","app","errors","title"],"type":"blade"}]},"route":{"uri":"GET login","middleware":"web","controller":"App\\Http\\Controllers\\Auth\\LoginController@showLoginForm","namespace":"App\\Http\\Controllers","prefix":null,"where":[],"as":"login","file":"vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Auth\/AuthenticatesUsers.php:17-20"},"queries":{"nb_statements":6,"nb_failed_statements":0,"accumulated_duration":0.0035,"accumulated_duration_str":"3.5ms","statements":[{"sql":"select * from `holiday_titles` limit 1","type":"query","params":[],"bindings":[],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","The <code>SELECT<\/code> statement has no <code>WHERE<\/code> clause and could examine many more rows than intended","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":15,"namespace":null,"name":"\/app\/Providers\/OptionsServiceProvider.php","line":19},{"index":24,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":28,"namespace":"middleware","name":"guest","line":24},{"index":73,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.00133,"duration_str":"1.33ms","stmt_id":"\/app\/Providers\/OptionsServiceProvider.php:19","connection":"shoppingcart"},{"sql":"select * from `holiday_titles` limit 1","type":"query","params":[],"bindings":[],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","The <code>SELECT<\/code> statement has no <code>WHERE<\/code> clause and could examine many more rows than intended","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":15,"namespace":null,"name":"\/app\/Providers\/OptionsServiceProvider.php","line":19},{"index":23,"namespace":"view","name":"auth.login","line":84},{"index":30,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":34,"namespace":"middleware","name":"guest","line":24},{"index":79,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.00031,"duration_str":"310\u03bcs","stmt_id":"\/app\/Providers\/OptionsServiceProvider.php:19","connection":"shoppingcart"},{"sql":"select * from `holiday_titles` limit 1","type":"query","params":[],"bindings":[],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","The <code>SELECT<\/code> statement has no <code>WHERE<\/code> clause and could examine many more rows than intended","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":15,"namespace":null,"name":"\/app\/Providers\/OptionsServiceProvider.php","line":19},{"index":23,"namespace":"view","name":"layouts.master","line":27},{"index":29,"namespace":"view","name":"auth.login","line":84},{"index":36,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":40,"namespace":"middleware","name":"guest","line":24},{"index":85,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.00047,"duration_str":"470\u03bcs","stmt_id":"\/app\/Providers\/OptionsServiceProvider.php:19","connection":"shoppingcart"},{"sql":"select exists(select * from `products` where `holiday_special` = '1') as `exists`","type":"query","params":[],"bindings":["1"],"hints":[],"backtrace":[{"index":10,"namespace":"view","name":"includes.header","line":16},{"index":16,"namespace":"view","name":"layouts.master","line":27},{"index":22,"namespace":"view","name":"auth.login","line":84},{"index":29,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":33,"namespace":"middleware","name":"guest","line":24},{"index":78,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.0005,"duration_str":"500\u03bcs","stmt_id":"view::includes.header:16","connection":"shoppingcart"},{"sql":"select * from `holiday_titles` limit 1","type":"query","params":[],"bindings":[],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","The <code>SELECT<\/code> statement has no <code>WHERE<\/code> clause and could examine many more rows than intended","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":15,"namespace":null,"name":"\/app\/Providers\/OptionsServiceProvider.php","line":19},{"index":23,"namespace":"view","name":"layouts.master","line":29},{"index":29,"namespace":"view","name":"auth.login","line":84},{"index":36,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":40,"namespace":"middleware","name":"guest","line":24},{"index":85,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.00041,"duration_str":"410\u03bcs","stmt_id":"\/app\/Providers\/OptionsServiceProvider.php:19","connection":"shoppingcart"},{"sql":"select * from `holiday_titles` limit 1","type":"query","params":[],"bindings":[],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","The <code>SELECT<\/code> statement has no <code>WHERE<\/code> clause and could examine many more rows than intended","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":15,"namespace":null,"name":"\/app\/Providers\/OptionsServiceProvider.php","line":19},{"index":23,"namespace":"view","name":"layouts.master","line":33},{"index":29,"namespace":"view","name":"auth.login","line":84},{"index":36,"namespace":null,"name":"\/vendor\/symfony\/http-foundation\/Response.php","line":201},{"index":40,"namespace":"middleware","name":"guest","line":24},{"index":85,"namespace":null,"name":"\/public\/index.php","line":53}],"duration":0.00047999999999999996,"duration_str":"480\u03bcs","stmt_id":"\/app\/Providers\/OptionsServiceProvider.php:19","connection":"shoppingcart"}]},"swiftmailer_mails":{"count":0,"mails":[]},"auth":{"guards":{"web":"array:2 [\n  \"name\" => \"Guest\"\n  \"user\" => array:1 [\n    \"guest\" => true\n  ]\n]","api":"array:2 [\n  \"name\" => \"Guest\"\n  \"user\" => array:1 [\n    \"guest\" => true\n  ]\n]"},"names":""},"gate":{"count":0,"messages":[]},"session":{"_token":"qROImxpKe6r3HVKE4KPjyyA2ijVB5ukuDHPRcn42","_previous":"array:1 [\n  \"url\" => \"http:\/\/127.0.0.1:8000\/login\"\n]","PHPDEBUGBAR_STACK_DATA":"[]"},"request":{"format":"html","content_type":"text\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:3 [\n  \"host\" => array:1 [\n    0 => \"127.0.0.1:8000\"\n  ]\n  \"user-agent\" => array:1 [\n    0 => \"curl\/7.55.1\"\n  ]\n  \"accept\" => array:1 [\n    0 => \"*\/*\"\n  ]\n]","request_server":"array:18 [\n  \"DOCUMENT_ROOT\" => \"\/home\/laurent\/public_html\/webcreation\/public\"\n  \"REMOTE_ADDR\" => \"127.0.0.1\"\n  \"REMOTE_PORT\" => \"40250\"\n  \"SERVER_SOFTWARE\" => \"PHP 7.1.12 Development Server\"\n  \"SERVER_PROTOCOL\" => \"HTTP\/1.1\"\n  \"SERVER_NAME\" => \"127.0.0.1\"\n  \"SERVER_PORT\" => \"8000\"\n  \"REQUEST_URI\" => \"\/login\"\n  \"REQUEST_METHOD\" => \"GET\"\n  \"SCRIPT_NAME\" => \"\/index.php\"\n  \"SCRIPT_FILENAME\" => \"\/home\/laurent\/public_html\/webcreation\/public\/index.php\"\n  \"PATH_INFO\" => \"\/login\"\n  \"PHP_SELF\" => \"\/index.php\/login\"\n  \"HTTP_HOST\" => \"127.0.0.1:8000\"\n  \"HTTP_USER_AGENT\" => \"curl\/7.55.1\"\n  \"HTTP_ACCEPT\" => \"*\/*\"\n  \"REQUEST_TIME_FLOAT\" => 1512057520.1923\n  \"REQUEST_TIME\" => 1512057520\n]","request_cookies":"[]","response_headers":"array:5 [\n  \"cache-control\" => array:1 [\n    0 => \"no-cache, private\"\n  ]\n  \"date\" => array:1 [\n    0 => \"Thu, 30 Nov 2017 15:58:40 GMT\"\n  ]\n  \"content-type\" => array:1 [\n    0 => \"text\/html; charset=UTF-8\"\n  ]\n  \"set-cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IllnUmlmZjBkRkdtcVFCaFZaQktESGc9PSIsInZhbHVlIjoiU3RtbklLZkZxR2FPV3ZBUklIK1hvaENBTFwvMUJvQmFxSmszRE0zYzYzWUVKYUxYdW5rR1A0SDNrNFk4MmQ3VXNxdGt2UUpkekdhRFk5dktRRVB2aHFBPT0iLCJtYWMiOiI0MjdlMWY5NjM3MTYwMDQzNGNjZTcxNDBmN2ExYjE4ODJkM2YwMmNkZjBkYmI3NTNlZTRjYzkwY2ExZmQwZWVkIn0%3D; expires=Thu, 30-Nov-2017 17:58:40 GMT; max-age=7200; path=\/\"\n    1 => \"laravel_session=eyJpdiI6IjNsQjZkdm5jTmxuRW00dXBVU04zc2c9PSIsInZhbHVlIjoiN016Mjc4S2hhYStYZ1FVbWM1QTY2bG9DT1AyUFhUcnAzTGsyN3VFYUhaeTkyWGc1XC9CcmJoYkFLUjFQQzhCaiszUkE1OFM2enptaEZzR1pRejQ4cDFBPT0iLCJtYWMiOiI5Y2ExNjExMDE4ZjZkNzk5ZjJkZjBjNDgzNDY3YTQ0ZmM3YzUwMjkyYTUyYTM5ZTVmOTM4NjI3ODUyZDBhZmU2In0%3D; expires=Thu, 30-Nov-2017 17:58:40 GMT; max-age=7200; path=\/; httponly\"\n  ]\n  \"Set-Cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IllnUmlmZjBkRkdtcVFCaFZaQktESGc9PSIsInZhbHVlIjoiU3RtbklLZkZxR2FPV3ZBUklIK1hvaENBTFwvMUJvQmFxSmszRE0zYzYzWUVKYUxYdW5rR1A0SDNrNFk4MmQ3VXNxdGt2UUpkekdhRFk5dktRRVB2aHFBPT0iLCJtYWMiOiI0MjdlMWY5NjM3MTYwMDQzNGNjZTcxNDBmN2ExYjE4ODJkM2YwMmNkZjBkYmI3NTNlZTRjYzkwY2ExZmQwZWVkIn0%3D; expires=Thu, 30-Nov-2017 17:58:40 GMT; path=\/\"\n    1 => \"laravel_session=eyJpdiI6IjNsQjZkdm5jTmxuRW00dXBVU04zc2c9PSIsInZhbHVlIjoiN016Mjc4S2hhYStYZ1FVbWM1QTY2bG9DT1AyUFhUcnAzTGsyN3VFYUhaeTkyWGc1XC9CcmJoYkFLUjFQQzhCaiszUkE1OFM2enptaEZzR1pRejQ4cDFBPT0iLCJtYWMiOiI5Y2ExNjExMDE4ZjZkNzk5ZjJkZjBjNDgzNDY3YTQ0ZmM3YzUwMjkyYTUyYTM5ZTVmOTM4NjI3ODUyZDBhZmU2In0%3D; expires=Thu, 30-Nov-2017 17:58:40 GMT; path=\/; httponly\"\n  ]\n]","path_info":"\/login","session_attributes":"array:3 [\n  \"_token\" => \"qROImxpKe6r3HVKE4KPjyyA2ijVB5ukuDHPRcn42\"\n  \"_previous\" => array:1 [\n    \"url\" => \"http:\/\/127.0.0.1:8000\/login\"\n  ]\n  \"PHPDEBUGBAR_STACK_DATA\" => []\n]"}}, "a320866c68dbf08ecdb13c0f4c3d77cc");

</script>
</body>
</html>
