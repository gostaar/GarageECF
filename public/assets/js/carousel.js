/* CARROUSEL JS */
function Carousel(elem) {
    this.nbSlide = 0;
    this.nbCurrent = 1;
    this.elemCurrent = null;
    this.elem = null;

    this.init = function() {
        this.nbSlide = elem.find(".slide").length;
        this.elem = elem;
        // Cacher tous les éléments
        elem.find(".slide").hide();
        // Assurez-vous que vous initialisez elemCurrent avec le premier élément
        this.elemCurrent = elem.find(".slide:first");
        this.elemCurrent.addClass('fade').fadeIn();  // Assurez-vous de montrer le premier élément avec l'effet fondu
    };
    
    this.next = function() {
        if (this.nbCurrent < this.nbSlide) {
            this.nbCurrent++;
        } else {
            this.nbCurrent = 1;
        }
        this.showSlide(this.nbCurrent);
    };

    this.prev = function() {
        if (this.nbCurrent > 1) {
            this.nbCurrent--;
        } else {
            this.nbCurrent = this.nbSlide;
        }
        this.showSlide(this.nbCurrent);
    };

    this.showSlide = function(index) {
        // Assurez-vous que elemCurrent est défini avant de l'utiliser
        if (this.elemCurrent !== null) {
            this.elemCurrent.fadeOut();
       // Vérifiez que l'élément trouvé n'est pas null avant de l'utiliser
       const newElem = elem.find(".slide:nth-child(" + index + ")").fadeIn();
       if (newElem !== null) {
           this.elemCurrent = newElem;
       }
   }
 };
}

