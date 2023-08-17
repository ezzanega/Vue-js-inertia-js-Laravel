
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


export const paymentProcessOptions = () => {
    return [
        {
            name: "20% - Accompte / 80% - Solde",
            value: '20-80'
        },

        {
            name: "30% - Accompte / 70% - Solde",
            value: '30-70'
        },
        {
            name: "40% - Accompte / 60% - Solde",
            value: '40-60'
        },
        {
            name: "50% - Accompte / 50% - Solde",
            value: '50-50'
        },
        {
            name: "60% - Accompte / 40% - Solde",
            value: '60-40'
        },
        {
            name: "70% - Accompte / 30% - Solde",
            value: '70-30'
        },
        {
            name: "80% - Accompte / 20% - Solde",
            value: '80-20'
        },
        {
            name: "Règlement en 1 fois",
            value: '0-100'
        },
    ];
}

export function getAdvanceOrBalance(value, type) {
    const [advance, balance] = value.split('-').map(Number);
    if (type === 'advance') {
        return advance;
    } else if (type === 'balance') {
        return balance;
    } else {
        return null;
    }
}


export const calculateTotalHT = (options, discount = 0) => {
    const total = options.reduce((total, option) => total + parseFloat(option.totalPriceHT), 0);
    return parseFloat(discount > 0 ? total - parseFloat(calculatePercentage(total, parseFloat(discount))) : total).toFixed(2);
};


export const calculatePercentage = (amount, percentage) => {
    return parseFloat((parseFloat(amount) * parseFloat(percentage)) / 100).toFixed(2);
}


export const calculateTTC = (totalAmountHT, amountTVA) => {
    return parseFloat(parseFloat(totalAmountHT) + parseFloat(amountTVA)).toFixed(2);
}
