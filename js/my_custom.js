(function($){
  'use strict';
  $(document).ready(function(){

    var download   = $('.download_link');
    download.on('click', function(e){
      e.preventDefault();
      var url      = $(this).attr('href');
      var original = $(this).text().trim();
      var edited   = $(this).parents('.field_item').find('.custom-input').val();

      console.log(url);
      console.log(original);
      console.log(edited);

      var request = $.ajax({
        url:'/download.php',
        type: 'post',
        data: { file: url,
                og:   original,
                edit: edited
              }
      });
      request.done(function(response, err, hxr){
        console.log(response);
        console.log(err);
        console.log(hxr);
      });
    });

    var update_btn = $('#file_container .field_item input[type="submit"]');

    update_btn.on('click',function(e) {
      e.preventDefault();

      var new_name      = $(this).siblings('.custom-input').val();
      var old_name      = $(this).parents('.field_item').find('.download_link').attr('href');
      var original_name = $(this).parents('.field_item').find('.download_link').text().trim();

      // console.log(new_name);
      // console.log(old_name);
      // console.log(original_name);

      var request = $.ajax({
        url:'/update.php',
        type: 'post',
        data: { item:     new_name,
                oldname:  old_name,
                original: original_name,
               }
      });

      request.done(function(response, err, obj){
        console.log(response);
        console.log(err);
        var replace_name = response;
        location.reload();

      });

    });


    $('#upload_form').on('submit',function(e){
      e.preventDefault();
      // Original File
      var oriArray  = $('.jFiler-item .ogfile');
      var nameArray = $('.jFiler-item .fileName');
      var fileArray = $('#filer_input')[0].files;
      var len       = fileArray.length;


      console.log(nameArray);

      for(var i = 0; i < len; i++) {
        var file       = fileArray[i];
        var edit_name  = nameArray[i].value;
        var orig_name  = oriArray[i].value;

        var formData = new FormData();
        //file $FILE
          formData.append('file', file, orig_name);
        //input name $POST
          formData.append('editname', edit_name);

          // for(var pair of formData.entries()) {
          //   console.log(pair[0] + ' , ' + pair[1], + ' ,' + pair[2]);
          // }

          (function(params){
            var request = $.ajax({
              url:'/upload.php',
              type: 'post',
              processData: false,
              contentType: false,
              data: params['item'],
              datatype: 'json'
            });
            //
            request.done(function(response, stats, jqXHR) {

              console.log(response);
              var res = JSON.parse(response);
              console.log(res);
              var file            = res.metas[0]['file'];
              var edited_name     = res.metas[0]['name'];
              var old_name        = res.metas[0]['old_name'];
              var ext             = res.metas[0]['extension'];

              // console.log(file);
              // console.log(edited_name);
              // // console.log(old_name);
              // console.log(ext);

              var list_container = $('#file_container .files');

              list_container.append(
                  "<div class='field_item'>" +
                  "<div class='field_box'>" +
                  "<label>Original Name<label>" +
                  "<a class='download_link' href=" + file + ">" + old_name +"</a></div>" +
                  "<h2>Edit the Current Name</h2>" +
                  "<input class='custom-input form-control' type='text' value="+ edited_name +">" +
                  "<input class='custom_button btn btn-info btn-sm' type='submit' value='Update'>" +
                  "</div>");

                });

          })({
            'item' : formData
          });
        }
        $('#filer_input').prop('jFiler').reset();
        location.reload();

      });

	$("#filer_input").filer({
    limit: null,
    maxSize: 1,
    extensions: ['css','js','php','html'],
    showThumbs: true,
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
      item: '<li class="jFiler-item">\
            <div class="jFiler-item-container">\
              <div class="jFiler-item-inner">\
                <div class="jFiler-item-thumb">\
                  <div class="jFiler-item-status"></div>\
                  <div class="jFiler-item-thumb-overlay">\
                    <div class="jFiler-item-info">\
                      <div style="display:table-cell;vertical-align: middle;">\
                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                      </div>\
                    </div>\
                  </div>\
                  {{fi-image}}\
                </div>\
                <div class="jFiler-item-assets jFiler-row">\
                <h2>Original File Name</h2>\
                <div>{{fi-name}}</div>\
                <input type="hidden" name="ogfile[]" class="ogfile" value="{{fi-name}}">\
                <h2>Edit File Name</h2>\
                <input class="custom-input form-control fileName" type="text" name="fileName[]" value="{{fi-name}}">\
                  <ul class="list-inline pull-left">\
                    <li>{{fi-progressBar}}</li>\
                  </ul>\
                  <ul class="list-inline pull-right">\
                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                  </ul>\
                </div>\
              </div>\
            </div>\
          </li>',
      itemAppend: '<li class="jFiler-item">\
              <div class="jFiler-item-container">\
                <div class="jFiler-item-inner">\
                  <div class="jFiler-item-thumb">\
                    <div class="jFiler-item-status"></div>\
                    <div class="jFiler-item-thumb-overlay">\
                      <div class="jFiler-item-info">\
                        <div style="display:table-cell;vertical-align: middle;">\
                          <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                          <span class="jFiler-item-others">{{fi-size2}}</span>\
                        </div>\
                      </div>\
                    </div>\
                    {{fi-image}}\
                  </div>\
                  <div class="jFiler-item-assets jFiler-row">\
                  <h2>Original File Name</h2>\
                  <div>{{fi-name}}</div>\
                  <input type="hidden" name="ogfile[]" class="ogfile" value="{{fi-name}}">\
                  <h2>Edit File Name</h2>\
                  <input class="custom-input  form-control fileName" type="text" name="fileName[]" value="{{fi-name}}">\
                    <ul class="list-inline pull-left">\
                      <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                    </ul>\
                    <ul class="list-inline pull-right">\
                      <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                    </ul>\
                  </div>\
                </div>\
              </div>\
            </li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			},
      addMore: true
		}
	});
  });
})(jQuery);
