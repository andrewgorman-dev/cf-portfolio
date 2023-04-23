var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
// Parent
var Locations = /** @class */ (function () {
    function Locations(city, image, date, zipCode, address) {
        this.city = city;
        this.image = image;
        this.date = date;
        this.zipCode = zipCode;
        this.address = address;
        this.city = city;
        this.image = image;
        this.date = date;
        this.zipCode = zipCode;
        this.address = address;
        destinations.push(this);
    }
    Locations.prototype.startCard = function () {
        return "<div class=\"col-sm-12 col-md-6 col-lg-4 g-3\">\n                    <div class=\" m-auto border p-1 outer-card d-flex justify-content-evenly align-items-center\" style=\"width: 24rem;\">\n                        <div class=\"card-body w-50\">\n                            <h5 class=\"card-title\">" + this.city + " <img src=\"img/icons/pin.svg\" alt=\"" + this.city + "\"></h5>\n                            <hr>\n                                    \n                                    \n                ";
    };
    Locations.prototype.midCard = function () {
        return "\n                            <p class=\"card-text address\">" + this.address + " <img src=\"img/icons/pin-fill.svg\" alt=\"\"></p>\n                            <p class=\"card-text zip\">ZIP Code: " + this.zipCode + "</p>\n                            <hr>\n        \n                ";
    };
    Locations.prototype.endDiv = function () {
        return "\n                            <p class=\"card-text\"><small class=\"text-muted\">Visited:<i class=\"card-date\"> " + new Date(this.date).toUTCString() + "</i></small></p>\n                        </div>\n                        <div class=\"w-50\">\n                            <img src=\"img/" + this.image + ".jpg\" class=\"border rounded card-image\" alt=\"image\">\n                        </div>\n                    </div>\n                </div>\n                ";
    };
    Locations.prototype.display = function () {
        return this.startCard() + this.midCard() + this.endDiv();
    };
    // Methods for sorting by Date
    Locations.prototype.returnDate = function () {
        return new Date(this.date);
    };
    Locations.prototype.returnDateSum = function () {
        return (this.returnDate().getFullYear() * 100) +
            ((this.returnDate()).getMonth() / 100) +
            ((this.returnDate()).getDay() / 1000) +
            ((this.returnDate()).getHours() / 10000) +
            ((this.returnDate()).getMinutes() / 100000) +
            ((this.returnDate()).getSeconds() / 1000000);
    };
    return Locations;
}());
// Subclasses
// Child 1
var Restaurant = /** @class */ (function (_super) {
    __extends(Restaurant, _super);
    function Restaurant(city, image, date, zipCode, resName, cuisine, tel) {
        var _this = _super.call(this, city, image, date, zipCode) || this;
        _this.city = city;
        _this.image = image;
        _this.date = date;
        _this.zipCode = zipCode;
        _this.resName = resName;
        _this.cuisine = cuisine;
        _this.tel = tel;
        _this.resName;
        _this.cuisine = cuisine;
        _this.tel = tel;
        return _this;
    }
    Restaurant.prototype.display = function () {
        return "\n                " + _super.prototype.startCard.call(this) + "\n                <p class=\"card-text zip\">Zip: " + this.zipCode + "</p>\n                <p class=\"card-text resName\">Dine: " + this.resName + " <img src=\"https://img.icons8.com/emoji/48/000000/fork-and-knife-emoji.png\"/></p>\n                <p class=\"card-text cuisine\">Cuisine: " + this.cuisine + "</p>\n                <p class=\"card-text tel\">Tel: +" + this.tel + "</p>\n                <hr>\n                " + _super.prototype.endDiv.call(this) + "\n                ";
    };
    return Restaurant;
}(Locations));
// Child 2
var Events = /** @class */ (function (_super) {
    __extends(Events, _super);
    function Events(city, eventName, image, date, eventDate, eventTime, eventPrice, eventLink) {
        var _this = _super.call(this, city, image, date) || this;
        _this.city = city;
        _this.eventName = eventName;
        _this.image = image;
        _this.date = date;
        _this.eventDate = eventDate;
        _this.eventTime = eventTime;
        _this.eventPrice = eventPrice;
        _this.eventLink = eventLink;
        _this.eventName = eventName;
        _this.eventDate = eventDate;
        _this.eventTime = eventTime;
        _this.eventPrice = eventPrice;
        _this.eventLink = eventLink;
        return _this;
    }
    Events.prototype.display = function () {
        return "\n                " + _super.prototype.startCard.call(this) + "\n                <p>" + this.eventName + " <img src=\"img/icons/calendar-event.svg\"/></p>\n                <p class=\"card-text evDate\">" + this.eventDate + "</p>\n                <p class=\"card-text evTime\">Start Time: " + this.eventTime + "</p>\n                <p class=\"card-text evPrice\">Tickets: " + this.eventPrice.toFixed(2) + "\u20AC</p>\n                <p class=\"card-text evLink\">Site: <a href=\"" + this.eventLink + "\" target=\"_about-blank\"><i>Website</i></a></p>\n                <hr>\n                " + _super.prototype.endDiv.call(this) + "\n                ";
    };
    return Events;
}(Locations));
// Store ALL instantiations in array
var destinations = [];
// Instantiate Locations objects
new Locations("Istanbul Mosque", "location1", "October 5, 2014 11:13", 34122, "Sultan Ahmet, Ayasofya Meydanı");
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
for (var _i = 0, destinations_1 = destinations; _i < destinations_1.length; _i++) {
    var place = destinations_1[_i];
    document.getElementById('place-cards').innerHTML
        += place.display();
}
