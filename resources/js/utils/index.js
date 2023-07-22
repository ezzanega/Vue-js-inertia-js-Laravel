
export const parseLocation = (result) => {
    return {
        address: getComponent(result, "street_number") + " " + getComponent(result, "route"),
        city: getComponent(result, "locality"),
        postal_code: getComponent(result, "postal_code"),
        country: getComponent(result, "country"),
        full_address: result.formatted_address,
        lat: result.geometry.location.lat,
        lng: result.geometry.location.lng,
        google_map_url: result.url,
    };
};

const getComponent = (result, type) => {
    let component = result.address_components.find((component) =>
        component.types.includes(type)
    );
    return component ? component.long_name : null;
};