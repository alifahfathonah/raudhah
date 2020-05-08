<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Payment;
use App\Registrant;

// use Maatwebsite\Excel\Concerns\ToCollection;

class PaymentsImport implements ToModel, WithStartRow
{
	/**
	* @param array $row
	*
	* @return User|null
	*/
	public function model(array $row)
	{
		
		$date = $this->transformDate($row[1]);
		$nova = $this->trimva($row[2]);
		$exists = Payment::where('paynumber', $nova)->first();
		if(!$exists){

			$update = Registrant::where('nova', $nova)->update(['paydate' => $date, 'isverified' => true]);
			if($update){
				$s = true;
			} else {
				$s = false;
			}
			return new Payment([
				'paydate'    => $date,
				'paynumber'  => $nova, 
				'paynominal' => $row[3],
				'status'		 => $s,
				]);
			}
		}

		public function trimva($va)
		{
			// 
			$left = substr($va, 0, 19);
			$exact = substr($left, 3, 16);
			return $exact;
		}
		
		
		public function transformDate($value, $format = 'Y-m-d')
		{
			try {
				return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
			} catch (\ErrorException $e) {
				return \Carbon\Carbon::createFromFormat($format, $value);
			}
		}
		
		public function startRow(): int
		{
			return 2;
		}
	}