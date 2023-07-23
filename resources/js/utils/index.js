
export const parseLocation = (result) => {
    return {
        address: getComponent(result, "street_number") + " " + getComponent(result, "route"),
        city: getComponent(result, "locality"),
        postalCode: getComponent(result, "postal_code"),
        country: getComponent(result, "country"),
        fullAddress: result.formatted_address,
        lat: result.geometry.location.lat,
        lng: result.geometry.location.lng,
        googleMapUrl: result.url,
    };
};


export const parseCompanyInformations = (result) => {
    return {
        organizationName: result.nom_entreprise,
        siren: result.siren_formate,
        siret: result.siege.siret_formate,
        codeNaf: result.code_naf,
        address: result.siege.adresse_ligne_1 + ' ' + (result.siege.adresse_ligne_2 ? result.siege.adresse_ligne_2 : ''),
        city: result.siege.ville,
        postalCode: result.siege.adresse_ligne_2 ? result.siege.adresse_ligne_2 : '',
        country: result.siege.pays,
        fullAddress: result.siege.adresse_ligne_1 + ' ' + (result.siege.adresse_ligne_2 ? result.siege.adresse_ligne_2 : '') + ' ' + (result.siege.code_postal ? result.siege.code_postal : '') + ' ' + result.siege.ville + ' ' + result.siege.pays,
    };
};


const getComponent = (result, type) => {
    let component = result.address_components.find((component) =>
        component.types.includes(type)
    );
    return component ? component.long_name : null;
};