
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

const getComponent = (result, type) => {
    let component = result.address_components.find((component) =>
        component.types.includes(type)
    );
    return component ? component.long_name : null;
};