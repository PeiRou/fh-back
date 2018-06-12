const profile = {
    'firstName' : 'Joe',
    'lastName' : 'Montana',
    'limit' : 20000.00
}

export default {
    getProfile (cb) {
        return cb(profile);
        // setTimeout(() => cb(profile), 200)
    }
}