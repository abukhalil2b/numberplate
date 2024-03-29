export default function () {
    
    Array.prototype.removeByValue = function (val) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] === val) {
                this.splice(i, 1);
                break;
            }
        }
        return this;
    };

/**  private: ['D','DD','DR','DW','DY','R','RR','RS','RM','RW','RY','S','SS','M','MM','MW','MY','W','WW','Y','YA','YY','A','AA','AB','AD','AR','AS','AM','AW','AY','B','BB','BH','BD','BR','BS','BW','BY','H','HH','HD','HR','HS','HY'],*/ 
    
return {

        plateType:'',

        private: [],

        commercial: [],

        diplomatic: [],

        temporary: [],

        export: [],

        specific: [],

        learner: [],

        government: [],

        other: [],

        codes: [],

        selectedCode : '',

        required: "pair",

        small: 0,

        medium: 0,

        large: 0,

        largeWithKhanjer: 0,

        bike: 0,

        plates: [],

        sizeForStatement: "",

        requiredFixingPlate:'',

        requiredBuyFrame:'',

        priceForPlate:0,

        showROPBillNumber:false,

        showPrintingOption:false,

        showFixingBuySaveBtn:false,

        selectPlateType(type) {
            
            this.resetValues();

            this.plateType = type;

            this.showFixingBuySaveBtn = true;

            this.codes = this.private;

            this.showROPBillNumber = ['private','commercial','specific','learner','government'].filter(t=>t == type).length > 0;

            this.showPrintingOption = ['private','commercial','diplomatic','specific','learner','government'].filter(t=>t == type).length > 0;
        },

        selectPairPlate() {
            this.required = "pair";
            this.resetValues();
        },

        selectSinglePlate() {
            this.required = "single";
            this.resetValues();
        },

        resetValues() {
            this.small = 0;
            this.medium = 0;
            this.large = 0;
            this.largeWithKhanjer = 0;
            this.bike = 0;
            this.plates = [];
            this.sizeForStatement = "";
        },

        setSizeForStatement(size, required) {
            if (required == "single") {
                this.sizeForStatement = size;
            }
            if (required == "pair") {
                if (this.plates.length == 1) {
                    this.sizeForStatement = size;
                } else {
                    if (this.plates[0] == this.plates[1]) {
                        this.sizeForStatement = size;
                    } else {
                        // CASE: small and medium THEN size = medium
                        if (
                            this.plates[0] == "medium" &&
                            this.plates[1] == "small"
                        ) {
                            this.sizeForStatement = "medium";
                        }

                        if (
                            this.plates[1] == "medium" &&
                            this.plates[0] == "small"
                        ) {
                            this.sizeForStatement = "medium";
                        }
                        // CASE: medium and large THEN size = large
                        if (
                            this.plates[0] == "large" &&
                            this.plates[1] == "medium"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        if (
                            this.plates[1] == "large" &&
                            this.plates[0] == "medium"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        // CASE: small and large THEN size = large
                        if (
                            this.plates[0] == "large" &&
                            this.plates[1] == "small"
                        ) {
                            this.sizeForStatement = "large";
                        }

                        if (
                            this.plates[1] == "large" &&
                            this.plates[0] == "small"
                        ) {
                            this.sizeForStatement = "large";
                        }
                    }
                }
            }
        },

        addSmall() {
           
            //do not mix with bike and largeWithKhanger
            if( this.plates.filter(plate=>plate == 'bike' || plate == 'largeWithKhanjer').length > 0){
                return;
            }

            if (this.small == 0 || this.small == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.small = this.small + 1;
                            this.plates.push("small");
                            this.setSizeForStatement("small", "pair");
                        }
                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.small = this.small + 1;
                            this.plates.push("small");
                            this.setSizeForStatement("small", "single");
                        }
                        break;
                }

                
            }
        },

        addMedium() {

            //do not mix with bike and largeWithKhanger
            if( this.plates.filter(plate=>plate == 'bike' || plate == 'largeWithKhanjer').length > 0){
                return;
            }

            if (this.medium == 0 || this.medium == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.medium = this.medium + 1;
                            this.plates.push("medium");
                            this.setSizeForStatement("medium", "pair");
                        }
                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.medium = this.medium + 1;
                            this.plates.push("medium");
                            this.setSizeForStatement("medium", "single");
                        }
                        break;
                }

                
            }
        },

        addLarge() {

            //do not mix with bike and largeWithKhanger
            if( this.plates.filter(plate=>plate == 'bike' || plate == 'largeWithKhanjer').length > 0){
                return;
            }

            if (this.large == 0 || this.large == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.large = this.large + 1;
                            this.plates.push("large");
                            this.setSizeForStatement("large", "pair");
                        }
                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.large = this.large + 1;
                            this.plates.push("large");
                            this.setSizeForStatement("large", "single");
                        }
                        break;
                }
            }
        },

        addLargeWithKhanjer() {

            //do not mix largeWithKhanger with others
            if( this.plates.filter(plate=> ['small','medium','large','bike'].find(s=>s==plate) == plate).length > 0){
                return;
            }

            if (this.largeWithKhanjer == 0 || this.largeWithKhanjer == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.largeWithKhanjer = this.largeWithKhanjer + 1;
                            this.plates.push("largeWithKhanjer");
                        }

                        this.sizeForStatement = "largeWithKhanjer";
                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.largeWithKhanjer = this.largeWithKhanjer + 1;
                            this.plates.push("largeWithKhanjer");
                        }

                        this.sizeForStatement = "largeWithKhanjer";
                        break;
                }
            }
        },

        addBike() {

            //do not mix bike with others
            if( this.plates.filter(plate=> ['small','medium','large','largeWithKhanjer'].find(s=>s==plate) == plate).length > 0){
                return;
            }

            if (this.bike == 0 || this.bike == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.bike = this.bike + 1;
                            this.plates.push("bike");
                            this.sizeForStatement = "bike";
                        }

                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.bike = this.bike + 1;
                            this.plates.push("bike");
                            this.sizeForStatement = "bike";
                        }

                        break;
                }
            }
        },

        subSmall() {
            if (this.small != 0) {
                this.small = this.small - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("small");

                
            }
        },

        subMedium() {
            if (this.medium != 0) {
                this.medium = this.medium - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("medium");

                
            }
        },

        subLarge() {
            if (this.large != 0) {
                this.large = this.large - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("large");
            }
        },

        subLargeWithKhanjer() {
            if (this.largeWithKhanjer != 0) {
                this.largeWithKhanjer = this.largeWithKhanjer - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("largeWithKhanjer");
            }
        },

        subBike() {
            if (this.bike != 0) {
                this.bike = this.bike - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("bike");
            }
        },

        /*-- show price for plate  input -- */
        showPriceInput(plateType){  
            return [].filter(item=>item == plateType).length > 0
        },

        /* start-- check for plate type is exist -- */
        showLargeWithKhanjer(plateType){
            
            return ['government'].filter(item=>item == plateType).length > 0
        },

        showLarge(plateType){
            
            return ['government','specific','private','commercial','diplomatic'].filter(item=>item == plateType).length > 0
        },

        showMedium(plateType){
            //this check no need to be applied
            return ['government','specific','private','commercial','learner','diplomatic','temporary','export'].filter(item=>item == plateType).length > 0
        },

        showSmall(plateType){
            
            return ['private','specific'].filter(item=>item == plateType).length > 0
        },

        showBike(plateType){
            
            return ['government','specific','private','commercial','learner','diplomatic','temporary'].filter(item=>item == plateType).length > 0
        }
        /* end-- check for plate type is exist -- */

    
  
    };
}
