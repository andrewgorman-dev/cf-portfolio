// // Last week we used buttons so this week I will try with new pages 
// But buttons is probably smoother :-)

function sortDesc(array: any) {
    array.sort(function (a: any, b: any) {
        return a.returnDateSum() - b.returnDateSum();
    });
    array.reverse();
}

// Call Desc
sortDesc(destinations);
// console.log(destinations);

// Populate HTML 'desc' Element with for loop
for (let place of destinations) {
    (document.getElementById('place-cards-desc') as HTMLElement).innerHTML
        += place.display();
}