export class ScanResult {
    scanData: string;
    scanAgain: boolean;

    constructor(scanData: string, scanAgain: boolean) {
        this.scanData = scanData,
        this.scanAgain = scanAgain
    }
}
