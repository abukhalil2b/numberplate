export default function () {
    return {
        plateType:'',

        private: ['D','DD','DR'],

        commercial: ['AK','BA','BK'],

        diplomatic: [],

        test: [],

        export: [],

        limitUse: [],

        codes: [],

        selectedCode : '',
        
        getPrivateCode() {
            this.plateType = 'private';

            this.codes = this.private
        },

        getCommercialCode() {
            this.plateType = 'commercial';

            this.codes = this.commercial
        },

        getDiplomaticCode() {
            this.plateType = 'diplomatic';

            this.codes = this.diplomatic
        },

        getTestCode() {
            this.plateType = 'test';

            this.codes = this.test
        },

        getExportCode() {
            this.plateType = 'export';

            this.codes = this.export
        },

        getLimitUseCode() {
            this.plateType = 'limit use';

            this.codes = this.limitUse
        },




    };
}
