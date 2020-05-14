<?php

namespace App\Exports;

use App\Registrant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\WorkSheet\WorkSheet;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\FromArray;



class RegistrantExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder, WithEvents
{
	use Exportable;
	
	//   public function __construct(int $year){
		//       $this->year = $year;
		//   }
		
		private $no = 1;
		private $data;
		private $title;
		
		public function __construct($data, $title)
		{
			$this->title = $title;
			return $this->data = $data;
		}
		
		public function collection()
		{
			// return Registrant::all();
			return $this->data;
		}
		
		public function bindValue(Cell $cell, $value)
		{
			if (is_numeric($value)) {
				if(floor(log10($value) + 1) >= 10){
					$cell->setValueExplicit($value, DataType::TYPE_STRING);
					return true;
				}
			}
			
			// else return default behavior
			return parent::bindValue($cell, $value);
		}
		
		public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
								$hone = 'A1:AU1'; // header line 1
								$htwo = 'A2:AU2'; // header line 2
								$htbl = 'A3:AU3'; // table headers
								$event->sheet->getDelegate()->mergeCells($hone);
                $event->sheet->getDelegate()->getStyle($hone)->getFont()->setSize(18);
								$event->sheet->getDelegate()->getStyle($hone)->getFont()->setBold(true);
								$event->sheet->getDelegate()->mergeCells($htwo);
                $event->sheet->getDelegate()->getStyle($htwo)->getFont()->setSize(14);
								$event->sheet->getDelegate()->getStyle($htwo)->getFont()->setItalic(true);
                $event->sheet->getDelegate()->getStyle($htbl)->getFont()->setSize(14);
								$event->sheet->getDelegate()->getStyle($htbl)->getFont()->setBold(true);
            },
        ];
    }
		
		
		public function headings(): array
		{
			return [
				['DATA CALON SANTRI ' . $this->title],
				['DIUNDUH TANGGAL ' . date('d/m/Y') . ' PUKUL ' . date('H:i')],
				['NO.',
				'NO. UJIAN',
				'ASRAMA',
				'KAMAR',
				'RUANG MAKAN',
				'RUANG BELAJAR',
				'VIRTUAL ACCOUNT',
				'PILIHAN PESANTREN',
				'NAMA LENGKAP',
				'PANGGILAN',
				'KARTU KELUARGA',
				'NIK PENDAFTAR',
				'NISN',
				'TEMPAT, TANGGAL LAHIR',
				'JENIS KELAMIN',
				'GOL. DARAH',
				'TINGGI/BERAT BADAN',
				// 
				'HOBBY',
				'CITA-CITA',
				'ANAK KE',
				'JUMLAH SAUDARA',
				'ASAL SEKOLAH',
				'NAMA SEKOLAH',
				'ALAMAT SEKOLAH',
				'NPSN',
				'NO. PESERTA UN',
				'NO. IJAZAH',
				'NO. SKHUN',
				// 
				'NAMA AYAH',
				'ALAMAT',
				'NO. HP/WHATSAPP',
				'NO. KTP',
				'PEND. TERAKHIR',
				'PEKERJAAN',
				'PENGHASILAN/BLN',
				'PENGHASILAN TAMBAHAN',
				'AGAMA',
				'STATUS PERNIKAHAN',
				'NAMA IBU',
				'ALAMAT',
				'NO. HP/WHATSAPP',
				'NO. KTP',
				'PEND. TERAKHIR',
				'PEKERJAAN',
				'PENGHASILAN/BLN',
				'PENGHASILAN TAMBAHAN',
				'AGAMA',]
				
			];
		}
		
		public function map($regs): array
		{
			if($regs->regparent['fwa']) $fwa = $regs->regparent['fwa']; else $fwa = '-';
			if($regs->regparent['mwa']) $mwa = $regs->regparent['mwa']; else $mwa = '-';
			$fsal = str_replace('.', '', $regs->regparent['fsal']); $fsal = explode(',', $fsal);
			$faddsal = str_replace('.', '', $regs->regparent['faddsal']); $faddsal = explode(',', $faddsal);
			$msal = str_replace('.', '', $regs->regparent['msal']); $msal = explode(',', $msal);
			$maddsal = str_replace('.', '', $regs->regparent['maddsal']); $maddsal = explode(',', $maddsal);
			return [
				$this->no++,
				$regs->examcard['numchar'],
				$regs->examcard['room']['building']['name'],
				$regs->examcard['room']['name'],
				$regs->examcard['foodtable']['name'],
				$regs->examcard['classroom']['building']['name'] . ' ' . $regs->examcard['classroom']['name'],
				$regs->nova,
				$regs->destination,
				$regs->name,
				$regs->nickname,
				$regs->kknumber,
				$regs->username,
				$regs->nisn,
				$regs->birthplace . ', ' . date('d/m/Y', strtotime($regs->birthdate)),
				$regs->gender == 1 ? 'LAKI-LAKI' : 'PEREMPUAN',
				$regs->bloodtype,
				$regs->height . ' cm' . ' / ' . $regs->weight . ' kg',
				$regs->hobby,
				$regs->wishes,
				$regs->numposition . ' DARI ' . ($regs->totalsiblings + 1) . ' BERSAUDARA',
				$regs->siblings . ' KANDUNG, ' . $regs->stepsiblings . ' TIRI',
				$regs->regschool['schfrom'],
				$regs->regschool['schname'],
				$regs->regschool['schstreet'] . ', ' . $regs->regschool['schkel'] . ', ' . $regs->regschool['schkec'] . ', ' . $regs->regschool['schkab'] . ', ' . $regs->regschool['schprov'],
				$regs->regschool['schpsn'],
				$regs->regschool['schun'],
				$regs->regschool['schijazah'],
				$regs->regschool['schskhun'],
				$regs->regparent['fname'],
				$regs->regparent['fadd'] . ', ' . $regs->regparent['fkel'] . ', ' . $regs->regparent['fkec'] . ', ' . $regs->regparent['fkab'] . ', ' . $regs->regparent['fprov'],
				$regs->regparent['fphone'] . ' / ' . $fwa,
				$regs->regparent['fktp'],
				$regs->regparent['fedu'],
				$regs->regparent['fwork'],
				$fsal[0],
				$faddsal[0],
				$regs->regparent['freli'],
				$regs->regparent['fmari'] == true ? 'MENIKAH' : 'BERCERAI',
				$regs->regparent['mname'],
				$regs->regparent['madd'] . ', ' . $regs->regparent['mkel'] . ', ' . $regs->regparent['mkec'] . ', ' . $regs->regparent['mkab'] . ', ' . $regs->regparent['mprov'],
				$regs->regparent['mphone'] . ' / ' . $mwa,
				$regs->regparent['mktp'],
				$regs->regparent['medu'],
				$regs->regparent['mwork'],
				$msal[0],
				$maddsal[0],
				$regs->regparent['mreli'],
			];
		}
		
		
		public function columnFormats(): array
		{
			return [
				// 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
				// 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
				'D' => NumberFormat::FORMAT_TEXT,
			];
		}
		
		
	}