jQuery(document).ready(function ($) {
  // Instantiates the variable that holds the media library frame.
  var cat_image;
  // Image Aside
  $("#cat-image-upload").click(function (e) {
    // Prevents the default action from occuring.
    e.preventDefault();

    // If the frame already exists, re-open it.
    if (cat_image) {
      cat_image.open();
      return;
    }

    // Sets up the media library frame
    cat_image = wp.media.frames.cat_image = wp.media({
      title: cat_meta.title,
      button: { text: cat_meta.button },
      library: { type: "image" },
    });

    // Runs when an image is selected.
    cat_image.on("select", function () {
      // Grabs the attachment selection and creates a JSON representation of the model.
      var media_attachment = cat_image
        .state()
        .get("selection")
        .first()
        .toJSON();

      // Sends the attachment URL to our custom image input field.
      $("#cat-image-preview").attr("src", media_attachment.url);
      $("#cat-image-url").val(media_attachment.url);
    });

    // Opens the media library frame.
    cat_image.open();
  });

  // Delete buttons
  $("#cat-image-delete").click(function (e) {
    e.preventDefault();
    var placeholder_url = $(this).data("placeholder-url");
    $("#cat-image-preview").attr("src", placeholder_url);
    $("#cat-image-url").val("");
  });
});

const triggerTabList = document.querySelectorAll('#bootstrap-options-tabs a.nav-item')
triggerTabList.forEach(triggerEl => {
  const tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', event => {
    event.preventDefault()
    tabTrigger.show()
  })
})
