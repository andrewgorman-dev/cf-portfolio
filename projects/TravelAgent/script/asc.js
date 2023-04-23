// Last week we used buttons so this week I will try with new pages 
// But buttons is probably smoother :-)
// ASCENDING SORT
function sortAsc(array) {
    array.sort(function (a, b) {
        return a.returnDateSum() - b.returnDateSum();
    });
}
// Call Asc
sortAsc(destinations);
// console.log(destinations);
// Populate HTML Element with for loop
for (var _i = 0, destinations_1 = destinations; _i < destinations_1.length; _i++) {
    var place = destinations_1[_i];
    document.getElementById('place-cards-asc').innerHTML
        += place.display();
}
