$(document).ready(function(){
   $("#create_emploi").css("display", "none");
   $("#create_stage").css("display", "none");
   $("#emploi").css("display", "none");
   $("#stage").css("display", "none");
   $("#update").css("display", "none");
    $("#pill1").click(function(){
		$("#info").css("display", "block");
        $("#create_emploi").css("display", "none");
        $("#create_stage").css("display", "none");
        $("#emploi").css("display", "none");
        $("#stage").css("display", "none");
		$("#update").css("display", "none");
    });
	$("#pill21").click(function(){
		$("#info").css("display", "none");
        $("#create_emploi").css("display", "block");
		$("#create_stage").css("display", "none");
        $("#emploi").css("display", "none");
        $("#stage").css("display", "none");
		$("#update").css("display", "none");
    });
	$("#pill22").click(function(){
		$("#info").css("display", "none");
		$("#create_emploi").css("display", "none");
        $("#create_stage").css("display", "block");
        $("#emploi").css("display", "none");
        $("#stage").css("display", "none");
		$("#update").css("display", "none");
    });
	$("#pill3").click(function(){
		$("#info").css("display", "none");
        $("#create_emploi").css("display", "none");
        $("#create_stage").css("display", "none");
        $("#emploi").css("display", "block");
        $("#stage").css("display", "none");
		$("#update").css("display", "none");
    });
	$("#pill4").click(function(){
		$("#info").css("display", "none");
        $("#create_emploi").css("display", "none");
        $("#create_stage").css("display", "none");
        $("#emploi").css("display", "none");
        $("#stage").css("display", "block");
		$("#update").css("display", "none");
    });
	$("#pill5").click(function(){
		$("#info").css("display", "none");
        $("#create_emploi").css("display", "none");
        $("#create_stage").css("display", "none");
        $("#emploi").css("display", "none");
        $("#stage").css("display", "none");
		$("#update").css("display", "block");
    });
});