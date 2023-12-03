import { ScanResult } from './scan-result';

describe('ScanResult', () => {
  it('should create an instance', () => {
    expect(new ScanResult('ScanData',false)).toBeTruthy();
  });
});
