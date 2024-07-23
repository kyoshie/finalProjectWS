function validateForm() {
    var title = document.forms["journalForm"]["title"].value;
    var date = document.forms["journalForm"]["date"].value;
    var issue = document.forms["journalForm"]["issue"].value;
    var volume = document.forms["journalForm"]["volume"].value;

    if (title == "" || date == "" || issue == "" || volume == "") {
        alert("All fields are required.");
        return false; 
    }
    return true; 
}


function validateArticle () {
    var title = document.forms["articleForm"]["title"].value;
    var authors = document.forms["articleForm"]["authors"].value;
    var abstract = document.forms["articleForm"]["abstract"].value;
    var keywords = document.forms["articleForm"]["keywords"].value;
    var ref = document.forms["articleForm"]["ref"].value;

    if (title == "" || authors == "" || abstract == "" || keywords == "" || ref == "") {
        alert("All fields are required.");
        return false; 
    }
    return true;



}