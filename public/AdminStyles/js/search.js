/* Search bar */

var resizeElements;

$(document).ready(function () {

    // Set up common variables
    // --------------------------------------------------

    var bar = ".search_bar";
    var input = bar + " input[type='text']";
    var button = bar + " button";
    var dropdown = bar + " .search_dropdown";
    var dropdownLabel = dropdown + " > span";
    var dropdownList = dropdown + " ul";
    var dropdownListItems = dropdownList + " li";


    // Set up common functions
    // --------------------------------------------------

    resizeElements = function () {
        var barWidth = $(bar).outerWidth();

        var labelWidth = $(dropdownLabel).outerWidth();
        $(dropdown).width(labelWidth);

        var dropdownWidth = $(dropdown).outerWidth();
        var buttonWidth = $(button).outerWidth();
        var inputWidth = barWidth - dropdownWidth - buttonWidth;
        var inputWidthPercent = inputWidth / barWidth * 100 + "%";

        $(input).css({'margin-left': dropdownWidth, 'width': inputWidthPercent});
    }

    function dropdownOn() {
        $(dropdownList).fadeIn(25);
        $(dropdown).addClass("active");
    }

    function dropdownOff() {
        $(dropdownList).fadeOut(25);
        $(dropdown).removeClass("active");
    }


    // Initialize initial resize of initial elements
    // --------------------------------------------------
    resizeElements();


    // Toggle new dropdown menu on click
    // --------------------------------------------------

    $(dropdown).click(function (event) {
        if ($(dropdown).hasClass("active")) {
            dropdownOff();
        } else {
            dropdownOn();
        }

        event.stopPropagation();
        return false;
    });

    $("html").click(dropdownOff);


    // Activate new dropdown option and show tray if applicable
    // --------------------------------------------------

    $(dropdownListItems).click(function () {
        $(this).siblings("li.selected").removeClass("selected");
        $(this).addClass("selected");

        // Focus the input
        $(this).parents("form.search_bar:first").find("input[type=text]").focus();

        var labelText = $(this).text();
        $(dropdownLabel).text(labelText);

        resizeElements();

    });


    // Resize all elements when the window resizes
    // --------------------------------------------------

    $(window).resize(function () {
        resizeElements();
    });
    $('li').click(function(){
        if($('li.selected').html()==='Personal'||$('li.selected').html()==='Biography'){
            $('#query').attr("placeholder", "No need to write search item");
            $("#query").prop('disabled', true);
        }
        else{
            $('#query').attr("placeholder", "Search for specific element");
            $("#query").prop('disabled', false);
        }
    });

    $('#submitquery').click(function (e) {
        if( !$('#query').val() && ($('li.selected').html()!=='Personal' && $('li.selected').html()!=='Biography')) {
            console.log($('li.selected').html());
            $('div > table').empty();
            $('div > table').append("<thead><tr><th style='color: red;'>Please enter a valid search item </th></tr></thead>");
        }
        else {
            $('#loading').html('<img src="/AdminStyles/images/Rolling-1s-96px.gif">');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/dashboard/search",
                method: 'post',
                data: {
                    query: jQuery('#query').val(),
                    type: jQuery('li.selected').html()
                },
                success: function (result) {
                    jQuery('div > table').empty();
                    if (result.status === '404') {
                        jQuery('div > table').append("<thead><tr><th>There is no result</th></tr></thead>");
                    }
                    else {
                        var keys=Object.keys(result.data[0]);
                        var table="<thead><tr>";
                        for(var i=0;i<keys.length;i++){
                            table+="<th class='text-left'>"+keys[i]+"</th>";
                        }
                        table+="<th>Edit</th>";
                        if($('#role').val()==="a"){
                            table+="<th>Delete</th>";
                        }
                        table+="</tr></thead><tbody>";
                        for(var i=0;i<result.data.length;i++){
                            table+="<tr>";
                            for(var j=0;j<keys.length;j++){
                                if(keys[j]==="photo"){
                                    table+="<td><img src='/"+result.data[i][keys[j]]+"' style='width: 200px;height: 200px;max-width: none;'>"+"</td>";
                                }
                                else{
                                    table+="<td style='overflow:hidden;'><h5 style='max-width:300px;color:#808080'>"+result.data[i][keys[j]]+"</h5></td>";
                                }
                            }
                            var href="/dashboard/"+result.type;
                            table+="<td>"+"<a href='"+href+"/"+result.data[i]['id']+"/edit'"+" class='au-btn au-btn-icon au-btn--green au-btn--small'>Edit</a>"+"</td>";
                            if($('#role').val()==="a"){
                                table+="<td>"+"<form style='margin: 0' action='"+href+"/"+result.data[i]['id']+"' method='post' >";
                                table+="<input type='hidden' name='_token' value='"+$('meta[name=csrf-token]').attr("content")+"'>";
                                table+="<input type='hidden' name='_method' value='DELETE'>";
                                table+="<button type='submit'"+" class='au-btn au-btn-icon au-btn--blue au-btn--small'>Delete</button>";
                                table+="</form>"+"</td>";
                            }
                            table+="</tr>"
                        }
                        table+="</tbody>";
                        $('#loading').html('');
                        jQuery('div > table').append(table);
                    }
                }
            });
        }
    });

});