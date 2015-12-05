var $collectionHolder;

var $addAddressLink = $('<a href="#" class="add_address_link">dodaj adres</a>');
var $newLinkLi = $('<li></li>').append($addAddressLink);

jQuery(document).ready(function() {
    $collectionHolder = $('ul.addresses');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAddressLink.on('click', function(e) {
        e.preventDefault();

        addAddressForm($collectionHolder, $newLinkLi);
    });
});

function addAddressForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    addAddressFormDeleteLink($newFormLi);
}

function addAddressFormDeleteLink($addressFormLi) {
    var $removeFormA = $('<a href="#">usuń adres</a>');
    $addressFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();

        $addressFormLi.remove();
    });
}