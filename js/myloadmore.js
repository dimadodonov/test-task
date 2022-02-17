jQuery(function ($) {
  // use jQuery code inside this to avoid "$ is not defined" error
  $(".show-more").click(function () {
    const button = $(this),
      btttonText = button.find(".show-more__button-text");
    data = {
      action: "loadmorebutton",
      query: misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
      page: misha_loadmore_params.current_page,
    };

    $.ajax({
      // you can also use $.post here
      url: misha_loadmore_params.ajaxurl, // AJAX handler
      data: data,
      type: "POST",
      beforeSend: function (xhr) {
        btttonText.text("Загружаю..."); // change the button text, you can also add a preloader image
      },
      success: function (data) {
        if (data) {
          btttonText.text("Показать еще"); // insert new posts
          $(".with-filter").append(data); // insert new posts
          misha_loadmore_params.current_page++;

          if (
            misha_loadmore_params.current_page == misha_loadmore_params.max_page
          )
            button.remove(); // if last page, remove the button

          // you can also fire the "post-load" event here if you use a plugin that requires it
          // $( document.body ).trigger( 'post-load' );
        } else {
          button.remove(); // if no data, remove the button as well
        }
      },
    });
  });

  /*
   * Filter
   */
  $("#page-filter").submit(function () {
    const filter = $("#page-filter"),
      button = $("#apply_filter");

    $.ajax({
      url: filter.attr("action"),
      data: filter.serialize(), // form data
      dataType: "json", // this data type allows us to receive objects from the server
      type: filter.attr("method"), // POST
      beforeSend: function (xhr) {
        button.text("Фильтрую...");
      },
      success: function (data) {
        // when filter applied:
        // set the current page to 1
        misha_loadmore_params.current_page = 1;

        // set the new query parameters
        misha_loadmore_params.posts = data.posts;

        // set the new max page parameter
        misha_loadmore_params.max_page = data.max_page;

        // insert the posts to the container
        $(".page-loop").html(data.content);

        // change the button label back
        button.text("Применить фильтры");

        // hide load more button, if there are not enough posts for the second page
        if (data.max_page < 2) {
          $(".show-more").hide();
        } else {
          $(".show-more").show();
        }
      },
    });

    // do not submit the form
    return false;
  });

  $("#reset_filter").on("click", function () {
    $(":input", "#page-filter")
      .not(":button, :submit, :reset, :hidden")
      .val("")
      .prop("checked", false)
      .prop("selected", false);

    const filter = $("#page-filter"),
      button = $("#apply_filter");

    $.ajax({
      url: filter.attr("action"),
      data: filter.serialize(), // form data
      dataType: "json", // this data type allows us to receive objects from the server
      type: filter.attr("method"), // POST
      beforeSend: function (xhr) {
        button.text("Фильтрую...");
      },
      success: function (data) {
        // when filter applied:
        // set the current page to 1
        misha_loadmore_params.current_page = 1;

        // set the new query parameters
        misha_loadmore_params.posts = data.posts;

        // set the new max page parameter
        misha_loadmore_params.max_page = data.max_page;

        // insert the posts to the container
        $(".page-loop").html(data.content);

        // change the button label back
        button.text("Применить фильтры");

        // hide load more button, if there are not enough posts for the second page
        if (data.max_page < 2) {
          $(".show-more").hide();
        } else {
          $(".show-more").show();
        }
      },
    });

    // do not submit the form
    return false;
  });
});
