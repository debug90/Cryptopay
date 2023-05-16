//https://eth-sepolia.g.alchemy.com/v2/gVDKkC9jTgtx9JQIyRBOrU1n21ovSeZT

require('@nomiclabs/hardhat-waffle');

module.exports = {
    solidity: '0.8.0',
    networks: {
        ropsten: {
            url: 'https://eth-sepolia.g.alchemy.com/v2/gVDKkC9jTgtx9JQIyRBOrU1n21ovSeZT',
            accounts: ['74950b04e935863765b103c27585a983029cd0f3e873246fdb1852d505474a08'],
        },
    },
};