// Last week we used buttons so this week I will try with new pages 
// But buttons is probably smoother :-)

// ASCENDING SORT
function sortAsc(array: any) {
    array.sort(function (a: any, b: any) {
        return a.returnDateSum() - b.returnDateSum();
    });
}

// Call Asc
sortAsc(destinations);
// console.log(destinations);

// Populate HTML Element with for loop
for (let place of destinations) {
    (document.getElementById('place-cards-asc') as HTMLElement).innerHTML
        += place.display();
}