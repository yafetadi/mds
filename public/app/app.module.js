(function () {

    'use strict';

    angular.module('appModule',
        ['dynamicNumber',
         'cashierApp'])

        .config(['dynamicNumberStrategyProvider', function(dynamicNumberStrategyProvider){
            dynamicNumberStrategyProvider.addStrategy('numericConverter', {
                numInt: 10,
                numFract: 4,
                numSep: '.',
                numPos: true,
                numNeg: true,
                numRound: 'round',
                numThousand: true,
                numThousandSep: '.',
            });
        }]);

})();
