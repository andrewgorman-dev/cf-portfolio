function sortDesc(array) {
    array.sort(function (a, b) {
        return a.returnDateSum() - b.returnDateSum();
    });
    array.reverse();
}
// function sortDesc(array: any) {
//     sortAsc(array);
//     array.reverse();
// }
// Call Desc
sortDesc(destinations);
// console.log(destinations);
// Populate HTML 'desc' Element with for loop
for (var _i = 0, destinations_1 = destinations; _i < destinations_1.length; _i++) {
    var place = destinations_1[_i];
    document.getElementById('place-cards-desc').innerHTML
        += place.display();
}
