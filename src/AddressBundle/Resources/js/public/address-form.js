var $collectionHolder;

var $addAddressButton = $('<button href="#" class="add_address_link btn btn-primary">dodaj adres</button>');

var $newLinkLi = $('<li></li>').append(
    $('<div class="form-group"></div>')
        .append($('<div class="col-sm-2"></div>'))
        .append(
        $('<div class="col-sm-10"></div>').append($addAddressButton)
    )
);

jQuery(document).ready(function() {
    $collectionHolder = $('ul.addresses');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAddressButton.on('click', function(e) {
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
    var $removeFormA = $('<button href="#" class="btn btn-danger">usun adres</button>');

    $addressFormLi.append(
        $('<div class="form-group"></div>')
            .append($('<div class="col-sm-2"></div>'))
            .append(
            $('<div class="col-sm-10"></div>').append($removeFormA)
        )
    );

    $removeFormA.on('click', function(e) {
        e.preventDefault();

        $addressFormLi.remove();
    });
}