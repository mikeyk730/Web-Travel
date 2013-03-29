      function startLoad()
      {
        var loaders = $('.loader');
        loaders.each(function(i, loader){
          $(loader).append($('<img src="../images/loading.gif"><span>Loading...</span>'));
        });
      }

      function endLoad()
      {
        var loaders = $('.loader');
        loaders.each(function(i, loader){
          $(loader).empty();
        });
      }
