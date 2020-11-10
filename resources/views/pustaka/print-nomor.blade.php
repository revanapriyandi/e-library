<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cetak Label Pustaka</title>
</head>

<body leftmargin="0" topmargin="0">
    <table border="0" cellspacing="5" cellpadding="5" width="780" align="left">
        <tr>
            <td align="left" valign="top">
                <div align="center">

                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                        <tr>
                            <td width="4%" align="right" valign="top"><strong class="news_title2">Judul&nbsp;:</strong>
                            </td>
                            <td width="96%" class="nav_title" align="left">{{ $pustaka->judul }}</td>
                        </tr>
                    </table>
                    @php
                    $i = 1;
                    $cellcnt = 1;
                    @endphp
                    @foreach ($daftarPustaka as $row)
                    @if ($cellcnt == 1 || $cellcnt % 9 == 1)
                    <table border='0' width='99%' cellspacing='0' cellpadding='5'>
                        @endif
                        @if ($i == 1 || $i % 3 == 1)
                        <tr>
                            @endif

                            @php
                            $kode = explode('/',$row->kodepustaka);
                            $barcode = $row->info1;
                            @endphp

                            <td width="33%" align="center">

                                <table border='1' cellpadding='2'
                                    style='border-width: 1px; border-style: dashed; border-collapse: collapse'>
                                    <br><br><br><br>
                                    <tr style='border-width: 1px; border-style: dashed; border-collapse: collapse'>
                                        <td align='center'>
                                            <font style='font-size: 12px;'>{{ $row->kodepustaka }}</font><br><br>
                                            <table width="200" border="1" cellspacing="0" cellpadding="0" class="tab2">
                                                <tr height="30">
                                                    <td align="center" style='font-size: 32px'>{{ $kode[0] }}</td>
                                                </tr>
                                                <tr height="30">
                                                    <td align="center" style='font-size: 32px'>{{ $kode[1] }}</td>
                                                </tr>
                                                <tr height="30">
                                                    <td align="center" style='font-size: 32px'>{{ $kode[2] }}</td>
                                                </tr>
                                                <tr height="30">
                                                    <td align="center" style='font-size: 32px'>{{ $kode[3] }}</td>
                                                </tr>
                                            </table>
                                            <br><br>
                                        </td>
                                    </tr>
                                    <tr style='border-width: 1px; border-style: dashed; border-collapse: collapse'>
                                        <td align='center'>
                                            <font style='font-size: 12px;'>{{ $row->kodepustaka }}</font><br><br>
                                            <img width='160'
                                                src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode, 'C39E')}}">
                                            <br><br>
                                        </td>
                                    </tr>
                                </table>

                            </td>

                            @if ($i % 3 == 0)
                        </tr>
                        @endif

                        @if ($cellcnt % 9 == 0)
                    </table><br><br><br><br><br><br><br>
                    @endif
                    @php
                    $i++;
                    $cellcnt += 1;
                    @endphp

                    @endforeach
            </td>
        </tr>
    </table>
</body>
<script language="javascript">
    window.print();
</script>

</html>
