function parseVideoURL(url) {
  function getParm(url, base) {
    let p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    return url.match(p) ? RegExp.$1 : "";
  }
  let retVal = {};
  let matches;
  let vimeo_Reg = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
  let vimeo_Reg2 = /https?:\/\/(?:player\.)?vimeo.com\/video\/(\d+)(?:$|\/|\?)/;
  let fb_reg = /(?:(?:https?:)?\/\/)?(?:www\.)?facebook\.com\/[a-zA-Z0-9\-_\.]+\/videos\/(?:[a-z0-9\.]+\/)?([0-9]+)\/?(?:\?.*)?/;
  if (url.match("http(s)?://(www.)?youtube|youtu.be")) {
    if (url.match("embed")) {
      retVal.id = url.split(/embed\//)[1].split('"')[0];
    } else {
      retVal.id = url.split(/v\/|v=|youtu\.be\//)[1].split(/[?&]/)[0];
    }
    retVal.provider = "youtube";
  } else if ((matches = url.match(vimeo_Reg))) {
    retVal.provider = "vimeo";
    retVal.id = matches[3];
  } else if ((matches = url.match(vimeo_Reg2))) {
    retVal.provider = "vimeo";
    retVal.id = matches[1];
  } else if ((matches = url.match(fb_reg))) {
    retVal.provider = "facebook";
    retVal.id = matches[1];
  }
  if (retVal.id == "" || retVal.id == undefined || retVal.id == "undefined") {
    //delete retVal;
    let retVal = false;
  }
  return retVal;
}

function getVideoInfo(link) {
  let video = parseVideoURL(link);
  let {id, provider} = video;
  let thumbnail = '';
  let videourl = '';
  
  if (provider == "vimeo") {
    thumbnail = "http://i.vimeocdn.com/video/" + id + "_1280.jpg";
    videourl = `http://player.vimeo.com/video/${id}`;
  } else if (provider == "facebook") {
    thumbnail = "https://graph.facebook.com/" + id + "/picture";
    videourl = `http://www.facebook.com/plugins/video.php?mute=0&href=${encodeURI(`https://www.facebook.com/facebook/videos/${id}`)}`;
  } else {
    thumbnail = "http://img.youtube.com/vi/" + id + "/1.jpg";
    videourl = `http://www.youtube.com/embed/${id}`;
  }
  if (video === false) {
    alert("Given URL is not a valid Youtube, Vimeo or Facebook resource!");
    return false;
  }
  return {
    ...video,
    thumbnail,
    videourl
  };
}

$(function() {

    // get Posts
    const sectionPosition = $('#add-section-here');

    let currentPid = firstPid;
    while (currentPid) {
      $.ajax({
        url: BASE_URL + "api/get_story_paragraph",
        data: {
          pid: currentPid,
        },
        dataType: 'json',
        method: 'POST',
        async: false,
        success: function(res) {
          let newSection = null;
          switch (res.type) {
            case 'text':
              newSection = $(`<div class='blog-pragraph'>${res.content}</div>`)
              break;
            case 'image':
              newSection = $(`
              <div class="">
                  <img class="img-fluid" src="${ASSETS_URL + 'media/stories/' + res.content}" alt="post image" onError="this.src='${ASSETS_URL + 'media/images/no-image-found.png'}';">
                  <div class="blog-pragraph image-caption">${res.caption ? res.caption : ''}</div>
              </div>
              `);
              break;
            case 'video':
              const videoInfo = getVideoInfo(res.content);
              newSection = $(`
              <div style="margin:0 auto 15px auto;text-align:center">
                <div class="video_holder" style="position:relative;padding-bottom:55%;padding-top:30px;height:0;overflow:hidden;width:100%;margin:5px auto;clear:both;">
                  <iframe src="${videoInfo.videourl}" style="position:absolute;height:100%;top:0;left:0;width:100%;border:0;" align="center"></iframe>
                </div>
              </div>`);
              break;
            case 'heading':
              newSection = $(`<h3 class="post-title">${res.content}</h3>`)
              break;
          }
          newSection.insertBefore(sectionPosition);
          currentPid = parseInt(res.nextPid);
        }
      });
    }
});

