
export const parseLocation = (result) => {
    return {
        address: getComponent(result, "street_number") + " " + getComponent(result, "route"),
        city: getComponent(result, "locality"),
        postalCode: getComponent(result, "postal_code"),
        country: getComponent(result, "country"),
        fullAddress: result.formatted_address,
        lat: result.geometry.location.lat(),
        lng: result.geometry.location.lng(),
        googleMapUrl: result.url,
    };
};


export const reformatLocation = (loaction) => {
    return {
        address: loaction.address,
        city: loaction.city,
        postalCode: loaction.postal_code,
        country: loaction.country,
        fullAddress: loaction.full_address,
        lat: loaction.lat,
        lng: loaction.lng,
        googleMapUrl: loaction.google_map_url,
    };
};


export const parseCompanyInformations = (result) => {
    return {
        organizationName: result.nom_entreprise,
        siren: result.siren_formate,
        siret: result.siege.siret_formate,
        codeApe: result.code_naf,
        address: result.siege.adresse_ligne_1 + ' ' + (result.siege.adresse_ligne_2 ? result.siege.adresse_ligne_2 : ''),
        city: result.siege.ville,
        postalCode: result.siege.code_postal,
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



export const getRoleLabel = (role) => {
    const roles = [
        {
            name: 'admin',
            label: 'Administrateur'
        },
        {
            name: 'sales',
            label: 'Commercial'
        },
        {
            name: 'operator',
            label: 'Déménageur'
        },
        {
            name: 'lead-operator',
            label: "Chef d'exploitation"
        }
    ];

    const roleObject = roles.find(r => r.name === role);
    return roleObject ? roleObject.label : 'Role not found';
};
