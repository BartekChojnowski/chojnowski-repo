
var PaginationTable = function() {
    /**
     * Unikalny identyfikator obiektu
     * @type {string}
     */
    this.identifier = '';

    /**
     * Zmienna prywatna agergująca dane wysłane do serwera POST'em.
     * @type {Object}
     */
    this.dataToSend = {};

    /**
     * Ilość wyników na stronie
     * @type {Object}
     */
    this.resultsOnPage = 10;

    /**
     * Zmienna przechowująca adres jakim posługuje się stronicownie.
     * @type {Object}
     */
    this.url = '';

    /**
     * Zmienna przechowująca obiekt kontenera z tabelą wyników.
     * @type {Object}
     */
    this.container;

    var that = this;

    /**
     * Metoda ustawia adres jakim posługuje się stronicownie
     *
     * @param url {string}
     */
    this.setUrl = function(url) {
        this.url = url;
    }

    /**
     * Metoda ustawia obiekt kontenera z tabelą wyników
     *
     * @param container
     */
    this.setContainer = function(container) {
        this.container = container;
    }

    /**
     * Przypisuje zdarzenia do poszczególnych elementów HTML
     */
    this.addEvents = function() {
        $(document).on('click', '.pagination-sort-icon', function(){sortBy( $(this).data('sort'),$(this).data('direction') )});
    }

    /**
     * Metoda prywatna, czyszczenie danych do wysłania.
     */
    function emptyDataToSend()
    {
        that.dataToSend = {};
    }

    this.openModal = function() {
        this.container.find('.pagination-fade').show();
        this.container.find('.pagination-loader').show();
    }

    this.closeModal = function() {
        this.container.find('.pagination-fade').hide();
        this.container.find('.pagination-loader').hide();
    }

    /**
     * Metoda wykonuje przeładowanie tabeli z wynikami.
     *
     * @param data {array}
     */
    function reload(data) {
        $.ajax({
            type: "POST",
            url: that.url,
            data: data,
            dataType: 'html',
            beforeSend:function(){
                that.openModal();
            }
        })
        .done(function (html) {
            that.container.html(html);
            that.addEvents();
            that.closeModal();
        })
    }

    /**
     * Metoda wykonuje zmianę strony z wynikami.
     *
     * @param page {int}
     */
    this.pageChange = function (page, data) {

        that.dataToSend = $.extend({}, data);
        that.dataToSend.page = page;

        reload(that.dataToSend);
    }

    /**
     * Metoda wykonuje odświerzenie tabeli z wynikami.
     */
    this.refresh = function () {
        reload(that.dataToSend);
    }

    /**
     * Metoda wykonuje zmianę ilości wyświetlanych wyników
     */
    this.changeResultsOnPage = function (resultsOnPage) {
        that.dataToSend.resultsOnPage = resultsOnPage;
        reload(that.dataToSend);
    }

    /**
     * Metoda wykonuje sortowanie wyświetlanych wyników
     */
    function sortBy (sort, direction) {
        that.dataToSend.sort = sort;
        that.dataToSend.direction = direction;
        reload(that.dataToSend);
    }
}