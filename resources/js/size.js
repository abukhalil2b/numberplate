export default function () {
    return {
        small: 0,
        medium: 0,
        large: 0,
        largeWithKhanjer: 0,
        bike: 0,

        addSmall() {
            if (this.small == 0 || this.small == 1)
            this.small = this.small + 1;
        },

        addMedium() {
            if (this.medium == 0 || this.medium == 1)
            this.medium = this.medium + 1;
        },

        addLarge() {
            if (this.large == 0 || this.large == 1)
            this.large = this.large + 1;
        },

        addLargeWithKhanjer() {
            if (this.largeWithKhanjer == 0 || this.largeWithKhanjer == 1)
            this.largeWithKhanjer = this.largeWithKhanjer + 1;
        },

        addBike() {
            if (this.bike == 0 || this.bike == 1)
            this.bike = this.bike + 1;
        },

        subSmall() {
            if (this.small != 0)
            this.small = this.small - 1;
        },

        subMedium() {
            if (this.medium != 0)
            this.medium = this.medium - 1;
        },

        subLarge() {
            if (this.large != 0) this.large = this.large - 1;
        },

        subLargeWithKhanjer() {
            if (this.largeWithKhanjer != 0)
            this.largeWithKhanjer = this.largeWithKhanjer - 1;
        },

        subBike() {
            if (this.bike != 0)
            this.bike = this.bike - 1;
        },
    };
}
