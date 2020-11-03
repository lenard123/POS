var q = "";
function search() {
    var query = $('#query').val();
    if (!valid(query))
        return clearSuggestion();

    showSearch(query);

    q = query;
    getResults(query);

}

function showSearch(query) {
    clearSuggestion();
    var searchItem = $('<div></div>');
    searchItem.addClass('item');
    searchItem.html('Searching : '+query);
    insertSuggestion(searchItem);
}

function clearSuggestion() {
    $('#suggestions').html('');
}

function insertSuggestion(suggestion) {
    $('#suggestions').append(suggestion);
}

function getResults(query) {
    if (query != q) return;
    axios.get('/search?query='+query)
         .then(response => showResult(response.data, query))
         .catch(error=>getResults(query));
}

function showResult(result, query) {
    if (query != q)
        return;
    clearSuggestion();
    for(var i in result) {
        var item = createItem(result[i]);
        insertSuggestion(item);
    }
}

function createItem(result) {
    var item = $('<div></div>');
    item.addClass('item');
    item.html(`
        <b>Name : ${result.name}</b><br/>
        Code : ${result.code}
    `)
    return item;
}

function valid(string) {
    string.trim();
    return string != "";
}
