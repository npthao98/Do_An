<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [ //1
                'name' => 'Áo phông nữ kiểu gấu bèo',
                'rate' => 5,
                'description' => 'Áo phông kiểu dài tay. Dáng regular, cổ tròn, gấu phối bèo',
                'price_import' => 100000,
                'price_sale' => 120000,
                'link_to_image_base' => 'product_1.jpg',
                'category_id' => 4,
            ],
            [ //2
                'name' => 'Áo phông nữ',
                'rate' => 5,
                'description' => 'Áo phông nữ',
                'price_import' => 100000,
                'price_sale' => 130000,
                'link_to_image_base' => 'product_2.jpg',
                'category_id' => 4,
            ],
            [ //3
                'name' => 'ÁO PHÔNG UNISEX NGƯỜI LỚN',
                'rate' => 5,
                'description' => 'Áo phông unisex người lớn',
                'price_import' => 110000,
                'price_sale' => 150000,
                'link_to_image_base' => 'product_3.jpg',
                'category_id' => 4,
            ],
            [ //4
                'name' => 'ÁO PHÔNG UNISEX NGƯỜI LỚN "VIETNAM DEFEATS COVID-19" BY LIM VOX',
                'rate' => 5,
                'description' => '"Vietnam defeats Covid-19" by LimVox. Với sự đoàn kết của người dân Việt Nam, sự kiên cường, chiến đấu không ngừng nghỉ của những bác sĩ - những "chiến binh áo trắng" cùng với toàn thể chiến sĩ dân quân và nhà nước ta, Việt Nam chắc chắn sẽ đánh bại được đại dịch Covid 19. Hình in 2 vị trí trước ngực và sau lưng',
                'price_import' => 110000,
                'price_sale' => 150000,
                'link_to_image_base' => 'product_4.jpg',
                'category_id' => 4,
            ],
            [ //5
                'name' => 'ÁO PHÔNG NỮ KIM TUYẾN',
                'rate' => 5,
                'description' => 'Áo phông chất liệu thun 4 chiều kim tuyến. Phom regular, cổ tim, tay dài, đường dúm dọc thân trước. Sản phẩm phù hợp với thời tiết thu đông. Tính ứng dụng cao phù hợp với việc đi làm, đi chơi, ... . Kiểu dáng đơn giản dễ kết hợp với các sản phẩm khác như chân váy, quần jeans,...',
                'price_import' => 130000,
                'price_sale' => 160000,
                'link_to_image_base' => 'product_5.jpg',
                'category_id' => 4,
            ],
            [ //6
                'name' => 'ÁO PHÔNG UNISEX NGƯỜI LỚN MICKEY',
                'rate' => 5,
                'description' => 'Áo phông unisex người lớn',
                'price_import' => 130000,
                'price_sale' => 165000,
                'link_to_image_base' => 'product_6.jpg',
                'category_id' => 4,
            ],
            [ //7
                'name' => 'ÁO PHÔNG UNISEX MICKEY GO VIETNAM',
                'rate' => 5,
                'description' => 'Áo phông unisex mickey go Vietnam',
                'price_import' => 135000,
                'price_sale' => 170000,
                'link_to_image_base' => 'product_7.jpg',
                'category_id' => 4,
            ],
            [ //8
                'name' => 'ÁO PHÔNG NỮ KẺ HỞ VAI',
                'rate' => 5,
                'description' => 'Áo kẻ, chất liệu cotton. Phom ôm sát, trễ vai, tay cộc.',
                'price_import' => 135000,
                'price_sale' => 175000,
                'link_to_image_base' => 'product_8.jpg',
                'category_id' => 4,
            ],
            [ //9
                'name' => 'ÁO PHÔNG NỮ BUỘC VẠT',
                'rate' => 5,
                'description' => 'Áo phông in hình chất liệu cottonPhom regular, cổ tròn, tay cộc. Buộc eo.',
                'price_import' => 140000,
                'price_sale' => 165000,
                'link_to_image_base' => 'product_9.jpg',
                'category_id' => 4,
            ],
            [ //10
                'name' => 'ÁO PHÔNG NỮ HÌNH IN 100% COTTON',
                'rate' => 5,
                'description' => 'Áo phông cotton USA in chữ trước ngực. Dáng regular, cổ tròn, dài tay',
                'price_import' => 135000,
                'price_sale' => 160000,
                'link_to_image_base' => 'product_10.jpg',
                'category_id' => 4,
            ],
            [ //11
                'name' => 'ÁO SƠ MI NỮ CHẤM BI',
                'rate' => 5,
                'description' => 'Áo sơ mi nữ chấm bi',
                'price_import' => 155000,
                'price_sale' => 170000,
                'link_to_image_base' => 'product_11.jpg',
                'category_id' => 5,
            ],
            [ //12
                'name' => 'ÁO SƠ MI HOA BÈO',
                'rate' => 5,
                'description' => 'Áo sơ mi nữ hoa bèo',
                'price_import' => 155000,
                'price_sale' => 170000,
                'link_to_image_base' => 'product_12.jpg',
                'category_id' => 5,
            ],
            [ //13
                'name' => 'ÁO SƠ MI NỮ KẺ CARO 100% COTTON',
                'rate' => 5,
                'description' => 'Áo sơ mi cotton USA hoạ tiết kẻ caro. Dáng regular, cổ đức, dài tay. Túi ốp ngực trái',
                'price_import' => 155000,
                'price_sale' => 170000,
                'link_to_image_base' => 'product_13.jpg',
                'category_id' => 5,
            ],
            [ //14
                'name' => 'ÁO SƠ MI NỮ KIỂU VAI PHỐI BÈO',
                'rate' => 5,
                'description' => 'Áo sơ mi kiểu vai phối bèo. Dáng thời trang, cổ đức, tay dài ống rộng. Cài khuy phía trước',
                'price_import' => 145000,
                'price_sale' => 175000,
                'link_to_image_base' => 'product_14.jpg',
                'category_id' => 5,
            ],
            [ //15
                'name' => 'ÁO SƠ MI NỮ HOẠ TIẾT HOA',
                'rate' => 5,
                'description' => 'Áo sơ mi họa tiết hoa. Dáng regular, cổ đức, ống tay rộng',
                'price_import' => 155000,
                'price_sale' => 170000,
                'link_to_image_base' => 'product_15.jpg',
                'category_id' => 5,
            ],
            [ //16
                'name' => 'ÁO SƠ MI NỮ KIỂU CỔ TIM',
                'rate' => 5,
                'description' => 'Áo sơ mi kiểu. Dáng thời trang, cổ tim, tay dài ống rộng. Cài khuy phía trước, phần eo hơi rúm',
                'price_import' => 200000,
                'price_sale' => 399000,
                'link_to_image_base' => 'product_16.jpg',
                'category_id' => 5,
            ],
            [ //17
                'name' => 'ÁO SƠ MI NỮ KHÔNG TAY',
                'rate' => 5,
                'description' => 'Áo sơ mi chấm bi polyester. Phom regular, cổ đức, sát nách. Áo đuôi tôm. Cài khuy phía trước. Nẹp rời.',
                'price_import' => 170000,
                'price_sale' => 209000,
                'link_to_image_base' => 'product_17.jpg',
                'category_id' => 5,
            ],
            [ //18
                'name' => 'ÁO SƠ MI NỮ KHÔNG TAY CAM',
                'rate' => 5,
                'description' => 'Đơn giản, lịch sự, phù hợp mặc nhiều hoàn cảnh. Thích hợp mặc xuân hè. Có thể kết hợp với quần jeans, quần khaki… với sandal, giày bệt.',
                'price_import' => 220000,
                'price_sale' => 280000,
                'link_to_image_base' => 'product_18.jpg',
                'category_id' => 5,
            ],
            [ //19
                'name' => 'ÁO SƠ MI NỮ KẺ TRẮNG',
                'rate' => 5,
                'description' => 'Áo sơ mi chất liệu cotton. Dáng thời trang, cổ đức, tay dài bồng. Cài khuy phía trước. Sản phẩm phù hợp với thời tiết thu đông. Tính ứng dụng cao phù hợp với việc đi làm, đi chơi, ... . Kiểu dáng đơn giản, năng động dễ kết hợp với các sản phẩm khác như áo phông, áo nỉ,...',
                'price_import' => 290000,
                'price_sale' => 400000,
                'link_to_image_base' => 'product_19.jpg',
                'category_id' => 5,
            ],
            [ //20
                'name' => 'ÁO SƠ MI NỮ CHẤM BI HỒNG',
                'rate' => 5,
                'description' => 'Áo sơ mi nữ chấm bi hồng',
                'price_import' => 300000,
                'price_sale' => 400000,
                'link_to_image_base' => 'product_20.jpg',
                'category_id' => 5,
            ],
            [ //21
                'name' => 'QUẦN JEANS NỮ CẠP CHUN',
                'rate' => 5,
                'description' => 'Quần jean cạp chun, có dây dệt điều chỉnh eo. Dáng regular, gấu bo chun, có túi 2 bên',
                'price_import' => 300000,
                'price_sale' => 500000,
                'link_to_image_base' => 'product_21.jpg',
                'category_id' => 6,
            ],
            [ //22
                'name' => 'QUẦN JEANS NỮ ỐNG LOE',
                'rate' => 5,
                'description' => 'Quần jeans dáng flare ống loe. Cạp thường, cài cúc và khóa kim loại',
                'price_import' => 300000,
                'price_sale' => 500000,
                'link_to_image_base' => 'product_22.jpg',
                'category_id' => 6,
            ],
            [ //23
                'name' => 'QUẦN JEANS NỮ SÁNG MÀU',
                'rate' => 5,
                'description' => 'Quần jeans nữ',
                'price_import' => 320000,
                'price_sale' => 550000,
                'link_to_image_base' => 'product_23.jpg',
                'category_id' => 6,
            ],
            [ //24
                'name' => 'QUẦN LEGGING ACTIVE NỮ',
                'rate' => 5,
                'description' => 'Quần legging, chất liệu polyester co giãn. Phom ôm sát, phối màu thân trước.',
                'price_import' => 120000,
                'price_sale' => 175000,
                'link_to_image_base' => 'product_24.jpg',
                'category_id' => 6,
            ],
            [ //25
                'name' => 'QUẦN KHAKI NỮ DÁNG ÔM',
                'rate' => 5,
                'description' => 'Quần khaki cotton co giãn. Phom slimfit, cạp thường, 4 túi. Phù hợp mặc quanh năm, kết hợp với áo phông, polo, giày búp bê, cao gót.',
                'price_import' => 150000,
                'price_sale' => 200000,
                'link_to_image_base' => 'product_25.jpg',
                'category_id' => 6,
            ],
            [ //26
                'name' => 'VÁY LIỀN NỮ HOẠ TIẾT HOA NHÍ',
                'rate' => 5,
                'description' => 'Váy liền họa tiết hoa nhí. Dáng fit&flare ôm vừa thân trên, xoè dưới, tay lỡ, cổ tròn',
                'price_import' => 320000,
                'price_sale' => 500000,
                'link_to_image_base' => 'product_26.jpg',
                'category_id' => 7,
            ],
            [ //27
                'name' => 'VÁY LIỀN NỮ CHẤM BI ĐEN',
                'rate' => 5,
                'description' => 'Váy liền nữ',
                'price_import' => 500000,
                'price_sale' => 700000,
                'link_to_image_base' => 'product_27.jpg',
                'category_id' => 7,
            ],
            [ //28
                'name' => 'VÁY LIỀN NỮ HOẠ TIẾT HOA BÉ',
                'rate' => 5,
                'description' => 'Váy liền nữ',
                'price_import' => 410000,
                'price_sale' => 550000,
                'link_to_image_base' => 'product_28.jpg',
                'category_id' => 7,
            ],
            [ //29
                'name' => 'VÁY LIỀN NỮ KẺ CARO 100% COTTON',
                'rate' => 5,
                'description' => 'Váy liền cotton USA, họa tiết kẻ caro. Dáng fit&flare, ôm vừa thân trên, xoè dưới. Có mở cúc dọc thân, chun eo',
                'price_import' => 150000,
                'price_sale' => 200000,
                'link_to_image_base' => 'product_29.jpg',
                'category_id' => 7,
            ],
            [ //30
                'name' => 'VÁY LIỀN NỮ DÁNG SUÔNG',
                'rate' => 5,
                'description' => 'Váy liền ngắn tay, dáng suông, cổ đức, túi ngực bên trái. Hàng khuy cài phía trước, có đai rời thắt eo',
                'price_import' => 490000,
                'price_sale' => 700000,
                'link_to_image_base' => 'product_30.jpg',
                'category_id' => 7,
            ],
            [ //31
                'name' => 'VÁY LIỀN NỮ HỌA TIẾT HOA',
                'rate' => 5,
                'description' => 'Váy liền hoạ tiết hoa. Dáng shift, suông hơi xòe thân dưới. Cổ đức, mở cúc thân trên',
                'price_import' => 330000,
                'price_sale' => 500000,
                'link_to_image_base' => 'product_31.jpg',
                'category_id' => 7,
            ],
            [ //32
                'name' => 'VÁY LIỀN NỮ TAY LỠ 100% COTTON',
                'rate' => 5,
                'description' => 'Váy liền vải dáng suông xoè nhẹ. Cổ tròn, tay lỡ, vai hơi bồng',
                'price_import' => 280000,
                'price_sale' => 400000,
                'link_to_image_base' => 'product_32.jpg',
                'category_id' => 7,
            ],
            [ //33
                'name' => 'VÁY LIỀN NỮ FIT&FLARE CỔ CHỮ V',
                'rate' => 5,
                'description' => 'Váy liền dáng fit&flare ôm thân trên, xoè dưới. Cổ chữ V, tay bồng, khuy cài phía trước',
                'price_import' => 310000,
                'price_sale' => 500000,
                'link_to_image_base' => 'product_33.jpg',
                'category_id' => 7,
            ],
            [ //34
                'name' => 'VÁY LIỀN NỮ BODY',
                'rate' => 5,
                'description' => 'Váy liền chất liệu rib polyester pha. Phom slim, cổ tròn, sát nách. Thích hợp mặc quanh năm. Phù hợp mặc đi làm, đi chơi… Có thể phối với áo khoác, cdigan... và kết hợp với giày, sandal, dép cao gót…',
                'price_import' => 110000,
                'price_sale' => 150000,
                'link_to_image_base' => 'product_34.jpg',
                'category_id' => 7,
            ],
            [ //35
                'name' => 'VÁY LIỀN NỮ KẺ CARO',
                'rate' => 5,
                'description' => 'Váy liền chất visco họa tiết kẻ caro. Phom regular, cổ đức, tay dài. Cài cúc thân trên, có đai buộc rời. Thích hợp mặc mùa thu đông. Kiểu dáng đơn giản, năng động, phù hợp nhiều hoàn cảnh. Phối hợp cùng giày thể thao, giày lười,…',
                'price_import' => 190000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_35.jpg',
                'category_id' => 7,
            ],
            [ //36
                'name' => 'CHÂN VÁY NỮ MINI VẠT LỆCH',
                'rate' => 5,
                'description' => 'Chân váy họa tiết kẻ. Dáng chữ A, vạt lệch có khóa giọt lệ. Cúc đính trang trí thân trước',
                'price_import' => 190000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_36.jpg',
                'category_id' => 8,
            ],
            [ //37
                'name' => 'CHÂN VÁY DENIM NỮ 100% COTTON',
                'rate' => 5,
                'description' => 'Chân váy mini denim dáng chữ A. Cạp thường, cúc cài, khoá phia trước',
                'price_import' => 290000,
                'price_sale' => 450000,
                'link_to_image_base' => 'product_37.jpg',
                'category_id' => 8,
            ],
            [ //38
                'name' => 'CHÂN VÁY NỮ ĐEN',
                'rate' => 5,
                'description' => 'Chân váy, họa tiết chấm bi. Dáng mini. xoè chữ A, hơi ôm, cạp thường, có khóa giọt lệ',
                'price_import' => 190000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_38.jpg',
                'category_id' => 8,
            ],
            [ //39
                'name' => 'CHÂN VÁY NỮ KẺ XÁM',
                'rate' => 5,
                'description' => 'Chân váy. Phom a line, dáng xòe.',
                'price_import' => 190000,
                'price_sale' => 240000,
                'link_to_image_base' => 'product_39.jpg',
                'category_id' => 8,
            ],
            [ //40
                'name' => 'CHÂN VÁY NỮ XÁM',
                'rate' => 5,
                'description' => 'Chân váy 1 lớp co giãn. phom a line, dáng xòe.',
                'price_import' => 190000,
                'price_sale' => 300000,
                'link_to_image_base' => 'product_40.jpg',
                'category_id' => 8,
            ],
            [ //41
                'name' => 'CHÂN VÁY JEANS NỮ MIDI SLIM FIT',
                'rate' => 5,
                'description' => 'Chân váy jeans. Dáng midi bút chì, xẻ trước. Cạp thường, có cúc, khóa kim loại',
                'price_import' => 390000,
                'price_sale' => 550000,
                'link_to_image_base' => 'product_41.jpg',
                'category_id' => 8,
            ],
            [ //42
                'name' => 'CHÂN VÁY NỮ MINI HỌA TIẾT HOA',
                'rate' => 5,
                'description' => 'Chân váy họa tiết hoa nhí. Dáng mini slim fit, có bèo nhún mặt trước',
                'price_import' => 210000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_42.jpg',
                'category_id' => 8,
            ],
            [ //43
                'name' => 'CHÂN VÁY NỮ HOẠ TIẾT HOA ',
                'rate' => 5,
                'description' => 'Chân váy mix kẻ họa tiết cotton co giãn. Phom regular, dáng A line. Túi hàm ếch.',
                'price_import' => 190000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_43.jpg',
                'category_id' => 8,
            ],
            [ //44
                'name' => 'CHÂN VÁY NỮ HỌA TIẾT',
                'rate' => 5,
                'description' => 'Chân váy nữ họa tiết',
                'price_import' => 200000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_44.jpg',
                'category_id' => 8,
            ],
            [ //45
                'name' => 'CHÂN VÁY NỮ MINI DÁNG CHỮ A',
                'rate' => 5,
                'description' => 'Chân váy họa tiết kẻ. Dáng chữ A, có khoá giọt lệ bên sườn',
                'price_import' => 190000,
                'price_sale' => 350000,
                'link_to_image_base' => 'product_45.jpg',
                'category_id' => 8,
            ],
            [ //46
                'name' => 'QUẦN SÓOC JEANS NỮ',
                'rate' => 5,
                'description' => 'Quần soóc denim cotton. Phom regular, dáng cộc. Túi hàm ếch.',
                'price_import' => 190000,
                'price_sale' => 315000,
                'link_to_image_base' => 'product_46.jpg',
                'category_id' => 9,
            ],
            [ //47
                'name' => 'QUẦN SOÓC NỮ MÀU KEM',
                'rate' => 5,
                'description' => 'Quần sóoc trơn, chất liệu cotton co giãn. Phom ôm sát, dáng cộc. Hai túi chéo trước. Đơn giản, thoải mái, phù hợp nhiều hoàn cảnh. Thích hợp mặc quanh năm. Kết hợp với áo phông, sơ mi…với sandal, giày thể thao...',
                'price_import' => 200000,
                'price_sale' => 370000,
                'link_to_image_base' => 'product_47.jpg',
                'category_id' => 9,
            ],
            [ //48
                'name' => 'QUẦN SOÓC NỮ VẢI THÔ',
                'rate' => 5,
                'description' => 'Quần soóc trơn, chất liệu cotton co giãn. Phom regular, dáng cộc. Hai túi hàm ếch trước. Hai túi ốp sau. Gấu lơ-vê. Đơn giản, thoải mái, phù hợp nhiều hoàn cảnh. Thích hợp mặc quanh năm. Kết hợp với áo phông, sơ mi…với sandal, giày thể thao...',
                'price_import' => 310000,
                'price_sale' => 470000,
                'link_to_image_base' => 'product_48.jpg',
                'category_id' => 9,
            ],
            [ //49
                'name' => 'QUẦN SOÓC NỮ BÒ',
                'rate' => 5,
                'description' => 'Quần soóc jeans, chất liệu denim cotton. Phom regular, dáng cộc, cạp cao. Túi chéo, gấu lơ-vê.',
                'price_import' => 210000,
                'price_sale' => 370000,
                'link_to_image_base' => 'product_49.jpg',
                'category_id' => 9,
            ],
            [ //50
                'name' => 'QUẦN SHORTS NỮ VẢI MỀM',
                'rate' => 5,
                'description' => 'Quần soóc chất liệu cotton polyetser. Phom regular, dập oze luồn dây dệt.',
                'price_import' => 110000,
                'price_sale' => 250000,
                'link_to_image_base' => 'product_50.jpg',
                'category_id' => 9,
            ],
            [ //51
                'name' => 'QUẦN SHORTS NỮ HỌA TIẾT KẺ',
                'rate' => 5,
                'description' => 'Quần shorts cotton USA kẻ sọc. Phom regular, dáng A, cạp cao, cài móc. Có dây đai thắt nơ. Mộc mạc, nhã nhặn. Phù hợp trong nhiều hoàn cảnh. Kết hợp với áo phông, sơ mi kiểu, với sandal,giày bệt.',
                'price_import' => 100000,
                'price_sale' => 150000,
                'link_to_image_base' => 'product_51.jpg',
                'category_id' => 9,
            ],
            [ //52
                'name' => 'QUẦN SHORTS NỮ CẠP CAO',
                'rate' => 5,
                'description' => 'Quần sóoc trơn, chất liệu polyester. Phom regular, dáng cộc, cạp cao.',
                'price_import' => 120000,
                'price_sale' => 250000,
                'link_to_image_base' => 'product_52.jpg',
                'category_id' => 9,
            ],
            [ //53
                'name' => 'QUẦN SHORTS NỮ MÀU TỐI',
                'rate' => 5,
                'description' => 'Phom regular, cạp cao, dáng A, 5 túi. Cài phía trước bằng khóa kéo và khuy kim loại. Thân mài rách nhẹ. Gấu lơ vê. Hiệu ứng giặt hạ màu',
                'price_import' => 100000,
                'price_sale' => 200000,
                'link_to_image_base' => 'product_53.jpg',
                'category_id' => 9,
            ],
            [ //54
                'name' => 'QUẦN SOÓC NỮ GẤU RÁCH',
                'rate' => 5,
                'description' => 'Quần sóoc jeans cotton co giãn. Phom ôm sát, dáng cộc.',
                'price_import' => 200000,
                'price_sale' => 330000,
                'link_to_image_base' => 'product_54.jpg',
                'category_id' => 9,
            ],
            [ //55
                'name' => 'QUẦN SOÓC NỮ XANH',
                'rate' => 5,
                'description' => 'Quần soóc trơn, chất liệu cotton co giãn. Phom regular, dáng cộc, túi chéo',
                'price_import' => 150000,
                'price_sale' => 250000,
                'link_to_image_base' => 'product_55.jpg',
                'category_id' => 9,
            ],
        ]);
    }
}
