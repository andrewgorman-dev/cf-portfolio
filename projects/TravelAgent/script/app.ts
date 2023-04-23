// Interface (Only Public Properties !!!)
interface Holidays {
    city: string;
    image: string
    date: any
    zipCode?: number
    address?: string
}

// Parent
class Locations implements Holidays {
    constructor(
        public city: string,
        public image: string,
        public date: any,
        public zipCode?: number,
        public address?: string
    ) {
        this.city = city;
        this.image = image;
        this.date = date;
        this.zipCode = zipCode;
        this.address = address;
        destinations.push(this);
    }


    startCard() {
        return `<div class="col-sm-12 col-md-6 col-lg-4 g-3">
                    <div class=" m-auto border p-1 outer-card d-flex justify-content-evenly align-items-center" style="width: 24rem;">
                        <div class="card-body w-50">
                            <h5 class="card-title">${this.city} <img src="img/icons/pin.svg" alt="${this.city}"></h5>
                            <hr>
                                    
                                    
                `
    }

    midCard() {
        return `
                            <p class="card-text address">${this.address} <img src="img/icons/pin-fill.svg" alt=""></p>
                            <p class="card-text zip">ZIP Code: ${this.zipCode}</p>
                            <hr>
        
                `
    }

    endDiv() {
        return `
                            <p class="card-text"><small class="text-muted">Visited:<i class="card-date"> ${new Date(this.date).toUTCString()}</i></small></p>
                        </div>
                        <div class="w-50">
                            <img src="img/${this.image}.jpg" class="border rounded card-image" alt="image">
                        </div>
                    </div>
                </div>
                `;
    }

    display() {
        return this.startCard() + this.midCard() + this.endDiv();
    }

    // Methods for sorting by Date
    returnDate() {
        return new Date(this.date);
    }

    returnDateSum() {
        return (this.returnDate().getFullYear() * 100) +
            ((this.returnDate()).getMonth() / 100) +
            ((this.returnDate()).getDay() / 1000) +
            ((this.returnDate()).getHours() / 10000) +
            ((this.returnDate()).getMinutes() / 100000) +
            ((this.returnDate()).getSeconds() / 1000000);
    }
}

// Subclasses
// Child 1
class Restaurant extends Locations {
    constructor(
        public city: string,
        public image: string,
        public date: string,
        public zipCode: number,
        public resName: string,
        public cuisine: string,
        public tel: number
    ) {
        super(city, image, date, zipCode);
        this.resName;
        this.cuisine = cuisine;
        this.tel = tel;
    }

    display() {
        return `
                ${super.startCard()}
                <p class="card-text zip">Zip: ${this.zipCode}</p>
                <p class="card-text resName">Dine: ${this.resName} <img src="https://img.icons8.com/emoji/48/000000/fork-and-knife-emoji.png"/></p>
                <p class="card-text cuisine">Cuisine: ${this.cuisine}</p>
                <p class="card-text tel">Tel: +${this.tel}</p>
                <hr>
                ${super.endDiv()}
                `;
    }
}

// Child 2
class Events extends Locations {
    constructor(
        public city: string,
        public eventName: string,
        public image: string,
        public date: string,
        public eventDate: string,
        public eventTime: string,
        public eventPrice: number,
        public eventLink: string
    ) {
        super(city, image, date);
        this.eventName = eventName;
        this.eventDate = eventDate;
        this.eventTime = eventTime;
        this.eventPrice = eventPrice;
        this.eventLink = eventLink;
    }

    display() {
        return `
                ${super.startCard()}
                <p>${this.eventName} <img src="img/icons/calendar-event.svg"/></p>
                <p class="card-text evDate">${this.eventDate}</p>
                <p class="card-text evTime">Start Time: ${this.eventTime}</p>
                <p class="card-text evPrice">Tickets: ${this.eventPrice.toFixed(2)}€</p>
                <p class="card-text evLink">Site: <a href="${this.eventLink}" target="_about-blank"><i>Website</i></a></p>
                <hr>
                ${super.endDiv()}
                `;
    }
}

// Store ALL instantiations in array
let destinations: Array<Locations> = [];

// Instantiate Locations objects
new Locations(
    "Istanbul Mosque",
    "location1",
    "October 5, 2014 11:13",
    34122, "Sultan Ahmet, Ayasofya Meydanı");
new Locations("Paris, Eiffel Tower", "location2", "November 7, 2008 16:14", 75007, "Parc du Champs de Mars, Ave Anatole");
new Locations("Gaudì Hotel", "location3", "December 17, 2016 09:33", 8001, "Cl Nou de la Rambla, 12, Barcelona");
new Locations("Nellim Village", "location4", "January 21, 2019 17:56", 09800, "Nellimintie 4230, Ivalo, Finland");

// Instantiate Restaurant objects
new Restaurant("Istanbul", "restro1", "July 5, 2017 11:13", 3456, "Grill", "Ocackbasi", 901123456);
new Restaurant("Paris", "restro2", "June 7, 2007 16:14", 75003, "L'Escargot", "Very French", 331123456);
new Restaurant("Barcelona", "restro3", "February 7, 2013 09:33", 56342, "La Inquisición", "Charcuterie", 341123456);
new Restaurant("Nellim", "restro4", "March 2, 2019 17:56", 1111, "Mätä kala", "Suomi", 3581123456);

// Instantiate Events objects
new Events("Istanbul", "Night Ferry", "event1", "October 15, 2015 11:13", "January 7", "17:00", 8, "https://turkeytravelplanner.com/go/istanbul/transport/istanbulferry.html");
new Events("Paris", "Boîte de Nuit", "event2", "November 17, 2007 16:14", "February 12", "00:00", 40, "https://www.french.hostelworld.com/blog/boite-de-nuit-paris/");
new Events("Barcelona", "Visit Casa Milà", "event3", "December 11, 2011 09:33", "February 12", "All Day", 10, "https://www.lapedrera.com/en");
new Events("Nellim (Lapland)", "Aurora Borealis", "event4", "January 1, 2010 17:56", "Oct-Mar", "All Night", 30, "https://www.nordicvisitor.com/europe-tours/scandinavia-northern-lights/");


// Populate HTML Element with for loop
for (let place of destinations) {
    (document.getElementById('place-cards') as HTMLElement).innerHTML
        += place.display();
}