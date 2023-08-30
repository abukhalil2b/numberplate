export default function () {
    return {
        plateType:'',

        private: ['D','DD','DR','DW','DY','R','RR','RS','RM','RW','RY','S','SS','M','MM','MW','MY','W','WW','Y','YA','YY','A','AA','AB','AD','AR','AS','AM','AW','AY','B','BB','BH','BD','BR','BS','BW','BY','H','HH','HD','HR','HS','HY'],

        commercial: ['AK','BA','BK'],

        diplomatic: ['CD'],

        temporary: [],

        export: [],

        specific: [],

        learners: [],

        government: [],

        other: [],

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

        getTemporaryCode() {
            this.plateType = 'temporary';

            this.codes = this.temporary
        },

        getExportCode() {
            this.plateType = 'export';

            this.codes = this.export
        },

        getLearnersCode() {
            this.plateType = 'learners';

            this.codes = this.learners
        },

        getSpecificCode() {
            this.plateType = 'specific';

            this.codes = this.specific
        },

        getGovernmentCode() {
            this.plateType = 'government';

            this.codes = this.government
        },

        getOtherCode() {
            this.plateType = 'other';

            this.codes = this.other
        },




    };
}
