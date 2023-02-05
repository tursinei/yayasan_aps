<?php

namespace App\Services;

use App\Http\Requests\StoreUsersRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersService
{

    public function listUser(Request $request){
        $search = $request->get('tsearch');
        $perans = Users::getPeran();
        $return = Users::select('id','name','email','created_at','peran')
                ->when($search,function($query) use ($search, $perans){
                  $querySearch = $query->where('name','like',"%$search%")
                                    ->orWhere('email','like',"%$search%");
                  if($index = array_search($search, $perans)){
                    $querySearch->orWhere('peran',$index);
                  }
                  return $querySearch;
                })->paginate(10);
        $ubah = $return->getCollection()->map(function($item){
            $item['peran'] = ucfirst(Users::getPeran($item['peran']));
            $item['created_at'] = date('d-m-Y',strtotime($item['created_at']));
            return $item;
        });
        $return->setCollection($ubah);
        return $return;
    }

    public function simpan(StoreUsersRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return Users::updateOrCreate(['id' => $request->input('id')], $data);
    }

    public function changePass(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->password = Hash::make($data['password']);
        return $user->save();
    }

    public function reportExcel()
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        $defaultStyle = (new StyleBuilder)->setFontName('Arial')->setFontSize(11)->build();
        $writer->setDefaultRowStyle($defaultStyle);

        $styleHeader = new Style();
        $styleHeader->setFontBold();
        $styleHeader->setFontName('Arial Narrow');
        $styleHeader->setShouldWrapText(false);
        $styleHeader->setFontSize(12);
        $writer->openToBrowser('list-participants.xlsx');
        $writer->setColumnWidth(10, 1);
        $writer->setColumnWidth(40, 2);
        $writer->setColumnWidth(50, 3);
        $writer->setColumnWidth(20, 4);
        $writer->setColumnWidth(25, 5);
        $writer->setColumnWidth(25, 6);
        $writer->setColumnWidth(20, 7);
        $writer->setColumnWidth(20, 8);
        $writer->setColumnWidth(20, 9);

        $title1 = WriterEntityFactory::createCell('List Abstracts', $styleHeader);
        $singleRow = WriterEntityFactory::createRow([$title1]);
        $writer->addRow($singleRow);

        $writer->addRow(WriterEntityFactory::createRow());
        $border = (new BorderBuilder)->setBorderBottom(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderLeft(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderRight(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            ->setBorderTop(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)->build();
        $styleHeader->setBorder($border);
        $styleHeader->setCellAlignment(CellAlignment::CENTER);
        $styleHeader->setBorder($border);
        $styleHeader->setBackgroundColor(Color::rgb(218, 227, 243));

        $namaKolom = ['Title', 'Name', 'Address', 'Country', 'Main Email', 'Second Email', 'Affiliation',
                        'Mobile Number', 'Phone Number'];
        $header = WriterEntityFactory::createRowFromArray($namaKolom, $styleHeader);
        $writer->addRow($header);
        $participantsData = [];//$this->getUsers(0);
        $styleCenter = (new StyleBuilder())->setBorder($border)->setCellAlignment(CellAlignment::CENTER)->build();
        $styleLeft = (new StyleBuilder())->setBorder($border)->setCellAlignment(CellAlignment::LEFT)->build();

        foreach ($participantsData as $row) {
            $perBaris = [
                WriterEntityFactory::createCell($row->title, $styleCenter),
                WriterEntityFactory::createCell($row->name, $styleLeft),
                WriterEntityFactory::createCell($row->address, $styleLeft),
                WriterEntityFactory::createCell($row->country, $styleLeft),
                WriterEntityFactory::createCell($row->email, $styleLeft),
                WriterEntityFactory::createCell($row->secondemail, $styleLeft),
                WriterEntityFactory::createCell($row->affiliation, $styleCenter),
                WriterEntityFactory::createCell($row->mobilenumber, $styleCenter),
                WriterEntityFactory::createCell($row->phonenumber, $styleCenter),
            ];
            $writer->addRow(WriterEntityFactory::createRow($perBaris));
        }
        $writer->close();
    }
}
