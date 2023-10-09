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

    return {
        required: "pair",
        small: 0,
        medium: 0,
        large: 0,
        largeWithKhanjer: 0,
        bike: 0,
        plates: [],
        sizeForStatement: "",
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

                console.log(this.plates);
            }
        },

        addMedium() {
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

                console.log(this.plates);
            }
        },

        addLarge() {
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
            if (this.bike == 0 || this.bike == 1) {
                switch (this.required) {
                    case "pair":
                        if (this.plates.length < 2) {
                            this.bike = this.bike + 1;
                            this.plates.push("bike");
                        }

                        this.sizeForStatement = "bike";
                        break;

                    case "single":
                        if (this.plates.length < 1) {
                            this.bike = this.bike + 1;
                            this.plates.push("bike");
                        }

                        this.sizeForStatement = "bike";
                        break;
                }
            }
        },

        subSmall() {
            if (this.small != 0) {
                this.small = this.small - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("small");

                console.log(this.plates);
            }
        },

        subMedium() {
            if (this.medium != 0) {
                this.medium = this.medium - 1;

                //remove this plate
                this.plates = this.plates.removeByValue("medium");

                console.log(this.plates);
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
    };
}
