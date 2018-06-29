$(document).ready(function() {	
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
	//Common variables
	var windowHeight = window.innerHeight;
	var windowWidth = window.innerWidth;
	var documentWidth = document.body.clientWidth;
	var documentHeight = document.body.clientHeight;
	var screenHeight = screen.height;
	var screenWidth = screen.width;

	// Animations initialization
	new WOW().init();
	
	// Initialize MDB select
	$('.mdb-select').material_select();
	
	// Initialize datetimepicker
	$('.datetimepicker').pickadate({
		// Escape any “rule” characters with an exclamation mark (!).
		format: 'mm/dd/yyyy',
		formatSubmit: 'yyyy/mm/dd',
		min: new Date(1970,1,01),
	});
	
	// Initialize timepicker
	$('.timepicker').pickatime({
		// 12 or 24 hour 
		twelvehour: true,
		autoclose: true,
		default: '18:00',
	});
	
	// Dropdown Init
	$('.dropdown-toggle').dropdown();
	
	// SideNav Scrollbar Initialization
	var sideNavScrollbar = document.querySelector('.custom-scrollbar');
	Ps.initialize(sideNavScrollbar);
	// SideNav Button Initialization
	$(".button-collapse").sideNav({
		edge: 'left', // Choose the horizontal origin
		closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
	});

	// Remove flash message if there is one after 8 seconds
	if($('.flashMessage').length == 1) {
		$('.flashMessage').animate({top:'+=' + ($('nav').height() + 150) + 'px'});
		setTimeout(function(){
			$('.flashMessage').animate({top:'-150px'}, function(){
				$('.flashMessage').remove();
			});
		}, 8000);
	}
	
	// Add playground to DOM after cloning default list item
	$('body').on('click', '.addPlayground', function(e) {
		var newItem = $(this).parents('.myPlayground').find('.defaultPlaygroundItem').clone();

		// Only add a max of 3 list items
		if($('ol.myPlaygroundsList').children().length < 4) {
			$(newItem).removeClass('defaultPlaygroundItem hidden')
				.removeAttr('hidden')
				.appendTo('ol.myPlaygroundsList')
				.find('select')
				.removeAttr('disabled')
				.addClass('mdb-select')
				.material_select();
			$(newItem).find('input').removeAttr('disabled');
			
			// Initialize timepicker
			$('.timepicker').pickatime({
				// 12 or 24 hour 
				twelvehour: true,
				autoclose: true,
				default: '18:00',
			});
			
		} else {
			toastr["info"]("You have reached the max amount of playgrounds to add");
		}
		
		// $('.mdb-select').material_select();
	});
	
	// Button toggle for writers article publish switch
	$('body').on("click", "button.publishBtn", function(e) {
		if(!$(this).hasClass('btn-danger')) {
			if($(this).children().val() == "Y") {
				$(this).addClass('active btn-success').removeClass('grey').children().attr("checked", true);
				$(this).siblings().addClass('grey').removeClass('active btn-danger').children().removeAttr("checked");
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').removeClass('grey').children().attr("checked", true);
				$(this).siblings().addClass('grey').removeClass('active btn-success').children().removeAttr("checked");
			}
		}	
	});
	
	//Toggle value for checked item
	$("body").on("click", ".registrationFormCard .profileSelection button", function(e) {
		$(this).add($(this).siblings()).toggleClass('green grey active');
		
		if($(this).children().attr('checked') == 'checked') {
			$(this).children().removeAttr('checked');
			$(this).siblings().children().attr('checked', 'checked');
		} else {
			$(this).children().attr('checked', 'checked');
			$(this).siblings().children().removeAttr('checked');
		}
	});
	
	// Toggle value for leagues ages and competition on leages edit page .
	// (Will toggle on and off. Not related to sibling option. Does not require a selection)
	$("body").on("click", ".compBtnSelect, .ageBtnSelect", function(e) {
		if($(this).hasClass('compBtnSelect')) {
			$(this).toggleClass('orange grey active');
			
			if($(this).children().attr('checked') == 'checked') {
				$(this).children().removeAttr('checked');
			} else {
				$(this).children().attr('checked', 'checked');
			}
		} else {
			$(this).toggleClass('blue grey active');
			
			if($(this).children().attr('checked') == 'checked') {
				$(this).children().removeAttr('checked');
			} else {
				$(this).children().attr('checked', 'checked');
			}
		}
	});
	
	//Toggle value for checked item for player profile type
	$("body").on("click", "button.playerTypeBtn", function(e) {
		if(!$(this).hasClass('green')) {
			$(this).siblings()
				.removeClass('green active')
				.addClass('grey')
				.children().removeAttr('checked');
			$(this)
				.addClass('green active')
				.removeClass('grey')
				.children().attr('checked', 'checked');		
		} else {
			$(this).removeClass('green active')
				.addClass('grey')
				.children().removeAttr('checked');
		}
	});

// // Remove session messages
	// if($(".message").length > 0 || $(".errors").length > 0) {
		// setTimeout(function() {
			// $(".message, .errors").fadeOut();
		// }, 7000);
	// }	
	
// // Scroll page to the bottom where selected league is
	// if($(".indLeague, .addVideoDiv").length > 0) {
		// $("body").animate({scrollTop:screenHeight+"px"}, "slow");
	// }
	
// // Change calendar user is viewing
	// var monthlyCalendar = $(".allCalendar_table");
	// var currentMonth = new Date().getMonth();
	// var counter = currentMonth + 12;
	
	// $("body").on("click", ".prevMonth, .nextMonth", function(e)	{		
		// if($(this).attr("class") == "prevMonth") {
			// if(counter > 0 && counter <= 23) {
				// counter--;
				// $(monthlyCalendar).each(function(){
					// $(this).hide();
				// });
				// $(monthlyCalendar[counter]).show();
			// }
			
			// return counter;

		// } else {
			// if(counter >= 0 && counter < 23) {
				// counter++;
				// $(monthlyCalendar).each(function() {
					// $(this).hide();
				// });
				// $(monthlyCalendar[counter]).show();
			// }
			
			// return counter;	
		// }
	// }); 
	
// // Remove rows more than 3 on calendar
	// function removeRows() {
		// $(".weekDayContent").each(function() { 
			// var numRows = $(this).find(".calendarMatchups").length;
			// if(numRows >= 4) {
				// $(this).find(".calendarMatchups:gt(2)").hide();
				// $(this).find(".moreGamesNotifi").show();
			// } else {
				// $(this).find(".moreGamesNotifi").hide();
			// }
		// });
	// }

	// Add league to players profile when accepted
	$("body").on("click", ".linkLeagueOption button", function(e) {
		var playerID = $(this).parent().find('[name="player_id"]').val();

		if($(this).hasClass("addLeague")) {
			$.ajax({
			  method: "PATCH",
			  url: "league_player/add_player_profile",
			  data: { player: playerID },
			})
			
			.fail(function() {	
				alert("Fail");
			})
			
			.done(function(data) {
				var returnData = data;

				if($(returnData).hasClass("okItem")) {
					$(leagueOption).slideUp(function() {
						$(leagueOption).remove();

						if($(".linkLeagueOption").length < 1) {
							$(".linkLeaguesDiv").fadeOut(function() {
								$(".linkLeaguesDiv").remove();
								location.reload();
							});
						}
					});
				} else if($(returnData).hasClass("errorItem")) {
					$(leagueOption).slideUp(function() {
						$(leagueOption).remove();

						if($(".linkLeagueOption").length < 1) {
							$(".linkLeaguesDiv").fadeOut(function() {
								$(".linkLeaguesDiv").remove();
								location.reload();
							});
						}
					});
				}
			});
		} else if($(this).hasClass("declineLeague")) {			
			$.post("update_player.php", {declinePlayerLeague:leagueID}, function(data) {
				var returnData = data;
				
				if($(returnData).hasClass("okItem")) {
					$(leagueOption).slideUp(function() {
						$(leagueOption).remove();

						if($(".linkLeagueOption").length < 1) {
							$(".linkLeaguesDiv").fadeOut(function() {
								$(".linkLeaguesDiv").remove();
								location.reload();
							});
						}
					});
				} else if($(returnData).hasClass("errorItem")) {
					$(leagueOption).slideUp(function() {
						$(leagueOption).remove();

						if($(".linkLeagueOption").length < 1) {
							$(".linkLeaguesDiv").fadeOut(function() {
								$(".linkLeaguesDiv").remove();
								location.reload();
							});
						}
					});
				}
			});
		} else {
			alert("Stop with the bafoolery");
		}
	});
	
// // Bring up calendar day with more information
	// $("body").on("click", ".weekDayContent", function(e) {
		// var dayData = $(this).clone(false);
		// var dayNum = $(this).find(".weekDayNum").text();
		// var year = $(this).parents("table").find(".showingYear").text();
		// var month = $(this).parents("table").find(".showingMonth").text();
		// var date = new Date(month + " " + dayNum + " " + year);
				
		// if(date.getDay() == 1) {
			// $(".calendar_modal #calendarDay").text("Monday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .gameTime").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
		// } else if(date.getDay() == 2) {
			// $(".calendar_modal #calendarDay").text("Tuesday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// } else if(date.getDay() == 3) {
			// $(".calendar_modal #calendarDay").text("Wednesday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// } else if(date.getDay() == 4) {
			// $(".calendar_modal #calendarDay").text("Thursday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// } else if(date.getDay() == 5) {
			// $(".calendar_modal #calendarDay").text("Friday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// } else if(date.getDay() == 6) {
			// $(".calendar_modal #calendarDay").text("Saturday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// } else if(date.getDay() == 0) {
			// $(".calendar_modal #calendarDay").text("Sunday");
			// $(".calendar_modal .calendarMatchups:gt(2)").show();
			// $(".calendar_modal .moreGamesNotifi").hide();
			// $(".calendar_modal .gameTime").show();
		// }

		// $(".calendar_modal_content").append(dayData);
		// $("#calendarDayNum").text(dayNum);
		// $(".calendar_modal .weekDayNum").unwrap().remove();
		// $(".calendar_modal, .maine_overlay").show();
		// if($(this).hasClass("homeGame")) {
			// $(".calendar_modal").animate({top:"50px", opacity:"1"}).addClass("homeBox");	
		// } else if($(this).hasClass("awayGame")) {
			// $(".calendar_modal").animate({top:"50px", opacity:"1"}).addClass("awayBox");
		// } else {
			// $(".calendar_modal").animate({top:"50px", opacity:"1"});
		// }
		
	// });	

// // Change up and down arrow if league exist or not (age unlimited)
	// var comp_age_clicks = 0;
	// $("body").on("click", ".comp_age_none", function() {
		// $(".unlimited").slideToggle(100);
		// comp_age_clicks++;
		// if($(".unlimited a").hasClass("unlimited_link")) {						
			// if ((comp_age_clicks % 2) == 0) {
				// $(".leagues_arrows_none").html("-");
			// } else {
				// $(".leagues_arrows_none").html("+");
			// }
		// } else {						
			// if ((comp_age_clicks % 2) == 0) {
				// $(".leagues_arrows_none").html("+");
			// } else {
				// $(".leagues_arrows_none").html("-");
			// }
		// }
	// });		
	
// // Turn on/off switch for show email
	// $('body').on("click", "#update_form_table button", function(e) {
		// if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
			// if($(this).children().val() == "Y") {
				// $(this).addClass('active btn-success').children().attr("checked", true);
				// $(this).siblings().removeClass('active btn-danger').children().removeAttr("checked");
			// } else if($(this).children().val() == 'N') {
				// $(this).addClass('active btn-danger').children().attr("checked", true);
				// $(this).siblings().removeClass('active btn-success').children().removeAttr("checked");
			// }
		// }
	// });
	
// // Bring up modal display for with League Information
	// $('body').on('click', '.quick_league', function(e) {
		// e.preventDefault();
		// var leagueInfoDiv = $(this).next().clone();	
		// $('.maine_overlay').show();
		// $('.leagues_modal .append_div').append(leagueInfoDiv);
		// $('.leagues_modal').fadeIn(function(){
			// $('.leagues_modal').animate({top:"20px"});
		// });
	// });
	
// // Bring up modal display for with Rec Information
	// $('body').on('click', '.quick_rec', function(e) {
		// e.preventDefault();
		// var recInfoDiv = $(this).next().clone();	
		// $('.maine_overlay').show();
		// $('.recs_modal .append_div').append(recInfoDiv);
		// $('.recs_modal').fadeIn(function(){
			// $('.recs_modal').animate({top:"20px"});
		// });
	// });
	
// // Show All Leagues For Age Group
	// $("body").on("click", ".comp_age_levels, .comp_level", function(e) {
		// var ageLevel = $(this).parent().attr("id");
		// $("#"+ageLevel+" .leagues_link").slideToggle(function() {
			// if($("#"+ageLevel+" .leagues_link").css("display") == "none") {
				// $("#"+ageLevel+" .leagues_arrows").text("-");
			// } else {
				// $("#"+ageLevel+" .leagues_arrows").text("+");
			// }
		// });
	// });

	
// // Add more videos to page
	// $("body").on("click", ".addMoreVideos", function(e)	{
		// var videoCount = $(".videoContent:last-of-type .uploadUser span").attr("class");
		// $.post("get_new_videos.php", {videoID:videoCount}, function(data) {			
			// var newContent = data;
			// $(data).insertBefore(".addMoreVideos");
			// if(Number($(".videoContent").length) == Number($(".totalVideos").text())) {
				// $(".addMoreVideos").text("All Videos Loaded").attr("class", "noMoreVideos");
			// }
		// });	
	// });	
	
// // Play videos on hover & bring up video if clicked on
	// $("body").on("click", ".videoContent", function () {
		// var video = $(this).children("video")[0];
		// var copyVideo = $(this).children("video").clone();
		// var videoUploader = $(this).find(".uploadUser").text();
		// video.pause();
		// copyVideo.attr({"controls": true, "autoplay": true}).appendTo(".video_modal_content");			
		// $(".video_modal .video_modal_header").text(videoUploader);	
		// $(".maine_overlay, .video_modal").fadeIn();
		// $(".video_modal").css({top:"20px"});
	// });
	// $("body").on("mouseenter", ".videoContent", function() {
		// $(this).children("video")[0].play();
	// });
	// $("body").on("mouseleave", ".videoContent", function() {
			// var el = $(this).children("video")[0];
			// $(this).find(".pause_overlay").show();
			// $(this).find(".pause_overlay p:first-of-type").css({"padding":"23% 0%"}).text("PAUSED!");
			// $(this).find(".pause_overlay p:last-of-type").hide();
			// el.pause();
	// });
	
// // Play videos when clicked on public player page
	// $("body").on("click", ".playerPageVideo, .editClips_div .myVideo .currentVideo", function () {
		// var video = $(this).children("video")[0];
		// var copyVideo = $(this).children("video").clone();
		// var videoUploader = $(this).find(".uploadUser").text();
		// var videoMaxHeight = screenHeight/2;
		// copyVideo.attr({"controls": true, "autoplay": true}).appendTo(".video_modal_content");			
		// $(".video_modal_header").text(videoUploader);
		// $(".maine_overlay").fadeIn();
		// $(".video_modal_content video.currentVideo").css({maxHeight:videoMaxHeight+"px"});
		// $('.video_modal').show().animate({top:"50px"});
	// });
	
// // View player profile video
	// $("body").on("click", ".viewClip", function(e) {
		// var myVideoView = $(this).parent().find(".currentVideo").clone();
		// myVideoView.attr({"controls": true, "autoplay": true}).appendTo(".append_div");			
		// $(".maine_modal .modal_title").text();
		// $(".append_div .currentVideo:gt(0)").remove();	
		// $(".maine_overlay").fadeIn();
		// $('.maine_modal').fadeIn(function(){
			// setTimeout(function() {
				// var maineModalHeight = $(".maine_modal").outerHeight();
				// var maineWrapperHeight = $(".maine_modal").outerHeight();
				// var newWrapperHeight;
				// if((maineWrapperHeight != maineModalHeight) || (maineWrapperHeight == maineModalHeight)) {
					// newWrapperHeight = maineModalHeight + 50;
					// $(".maine_modal").css({"height":newWrapperHeight+"px"});					
					// console.log("Modal height = " + maineModalHeight);
					
				// }
			// }, 100);
		// }).css({top:window.pageYOffset+"px"});
	// });
	
	// Bring up new video form to add a new video
	$('body').on('click', '.addVideo', function() {
		$('.uploadNewVideo').slideDown();
	});
	
	// Bring up delete modal for player video
	$('body').on('click', '.deletePlayerVideo', function() {
		var videoID = $(this).children('input').val();
		
		$('#modalConfirmDelete form').attr('action', window.location.protocol + '//' + window.location.hostname + '/highlight_remove/' + videoID);
	});
	
	// Stop carousel when show all recs button clicked
	$("body").on("click", "#showAllRecs", function(e)	{
		$(".carousel-item .col-md-4").unwrap().addClass('my-2');
		$('.carousel').carousel('pause');
		$('.carousel .controls-top, .carousel .carousel-indicators').add($(this)).remove();
	});
	
	// Make button active once a new file is added for changing 
	// player profile image
	$('body').on('change', '#file', function() {
		$('.changePlayerImage').addClass('pulse');
		$('.changePlayerImage button').addClass('btn-success').removeClass('stylish-color').removeAttr('disabled');
	});
	
	// Make button active for adding a new highlight on the player 
	// profile page
	$('body').on('change', '#new_video_file', function() {
		$('.addNewVideo').addClass('btn-outline-success active')
			.removeAttr('btn-outline-warning');
	});

	// Upload new player profile image
	$('body').on('click', '.changePlayerImageBtn', function() {
		var formData = new FormData();
		var playerID = $('.indPlayer').val();
		formData.append("file", document.getElementById('file').files[0]);
		
		$.ajax({
			url: "/player_images/" + playerID,
			method: "POST",
			data: formData,
			contentType: false,
			processData: false,
			cache: false,
			xhr: function() {
				var xhr = new XMLHttpRequest();
				
				xhr.upload.addEventListener('progress', function(e) {
					var progressbar = Math.round((e.loaded/e.total) * 100);
					$('#progress_modal').modal('show');
					$('#pro').css('width', progressbar + '%').text(progressbar + '%');
				});
				
				return xhr;
			},
			success: function(data) {
				$('#progress_modal').modal('hide');
				$('.changePlayerImage button').addClass('stylish-color')
					.removeClass('btn-success')
					.attr('disabled', 'disabled');
				$('.file-path-wrapper input')
					.val('')
					.text('')
					.removeClass('valid');
				
				setTimeout(function() {
					$('#update_pic img').attr('src', window.location.protocol + '//' + window.location.hostname + '/' + data.path);
					$('.textLoad').load('/home');
				}, 500);
			},
		});
		
		return false;
	});
	
	// Upload new player profile highlight
	$('body').on('click', '.btn-outline-success.addNewVideo.active', function() {
		var formData = new FormData();
		var playerID = $('.indPlayer').val();
		formData.append("new_video_file", document.getElementById('new_video_file').files[0]);
		
		$.ajax({
			url: "/player_highlights/" + playerID,
			method: "POST",
			data: formData,
			contentType: false,
			processData: false,
			cache: false,
			xhr: function() {
				var xhr = new XMLHttpRequest();
				
				xhr.upload.addEventListener('progress', function(e) {
					var progressbar = Math.round((e.loaded/e.total) * 100);
					$('#progress_modal').modal('show');
					$('#pro').css('width', progressbar + '%').text(progressbar + '%');
				});
				
				return xhr;
			},
			success: function(data) {
				$('#progress_modal').modal('hide');
				$('.addNewVideo').addClass('btn-outline-warning ')
					.removeClass('btn-outline-success active');
				$('.file-path-wrapper input')
					.val('')
					.text('')
					.removeClass('valid');
				$('.textLoad').load('/home .playerVideos', function(response, status, xhr) {
					if(status == 'success') {
						$('.playerProfileContainer .playerVideos').remove();
						$('.textLoad .playerVideos').insertAfter('.playerPlaygrounds');
					} else {
						
					}
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
		});
		
		return false;
	});
});

// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

// MDB Lightbox Init
$(function () {
	$("#mdb-lightbox-ui").load("/addons/mdb-lightbox-ui.html");
});