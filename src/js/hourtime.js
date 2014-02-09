var hourtime = {};
( function () {
    var srcdir = "src/";
    var phpdir = "src/php/";
    var htphpfile = "src/php/hourtime.php";
    var getCategory_type = function () {
        $.post(htphpfile,
            {
                "function": "getCategory_type"
            }
        ).done(function(data){
            return $.parseJSON(data);
        });
    }
    
    hourtime.getCategory_type = getCategory_type;
})();
