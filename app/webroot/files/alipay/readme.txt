            �q�����������������������������������������������r
  �q����������           ֧��������ʾ���ṹ˵��             �����������r
  ��        �t�����������������������������������������������s        ��
����                                                                  ��
����     �ӿ����ƣ�֧������ʱ���ʽӿڣ�create_direct_pay_by_user��    ��
������   ����汾��3.1                                                ��
  ��     �������ԣ�PHP                                                ��
  ��     ��    Ȩ��֧�������й������缼�����޹�˾                     ��
����     �� �� �ߣ�֧�����̻���ҵ������֧����                         ��
  ��     ��ϵ��ʽ���̻�����绰0571-88158090                          ��
  ��                                                                  ��
  �t�������������������������������������������������������������������s

��������������
 �����ļ��ṹ
��������������

js_php_utf8
  ��
  ��class���������������������������ļ���
  ��  ��
  ��  ��alipay_function.php���������ú������ļ�
  ��  ��
  ��  ��alipay_notify.php��������֧����֪ͨ�������ļ�
  ��  ��
  ��  ��alipay_service.php ������֧�������������ļ�
  ��
  ��images ����������������������ͼƬ��CSS��ʽ�ļ���
  ��
  ��log.txt������������������������־�ļ�
  ��
  ��alipay_config.php������������������Ϣ�����ļ�
  ��
  ��alipayto.php ����������������֧�����ӿ�����ļ�
  ��
  ��index.php�����������������������ٸ������ģ���ļ�
  ��
  ��notify_url.php ���������������������첽֪ͨҳ���ļ�
  ��
  ��return_url.php ��������������ҳ����תͬ��֪ͨ�ļ�
  ��
  ��readme.txt ������������������ʹ��˵���ı�

��ע���
��Ҫ���õ��ļ��ǣ�alipay_config.php��alipayto.php

index.php����֧�����ṩ�ĸ������ģ���ļ�����ѡ��ʹ�á�
����̻���վ����ҵ��������Ҫʹ�ã����alipayto.php��Ϊ���̻���վ��վ���ν�ҳ�档
�����Ҫʹ��index.php����ôalipayto.php�ļ�������ģ�ֻ�����ú�alipay_config.php�ļ�
�õ�index.phpҳ�����̻���վ�е�HTTP·���������̻���վ����Ҫ��λ�ã�����ֱ��ʹ��֧�����ӿڡ�


������������������
 ���ļ������ṹ
������������������

alipay_function.php

function build_mysign($sort_array,$key,$sign_type = "MD5")
���ܣ�����ǩ�����
���룺Array  $sort_array Ҫǩ��������
      String $key ��ȫУ����
      String $sign_type ǩ������ Ĭ��ֵ MD5
�����String ǩ������ַ���

function create_linkstring($array)
���ܣ�����������Ԫ�أ����ա�����=����ֵ����ģʽ�á�&���ַ�ƴ�ӳ��ַ���
���룺Array  $array ��Ҫƴ�ӵ�����
�����String ƴ������Ժ���ַ���

function para_filter($parameter)
���ܣ���ȥ�����еĿ�ֵ��ǩ������
���룺Array  $parameter ǩ��������
�����Array  ȥ����ֵ��ǩ�����������ǩ��������

function arg_sort($array)
���ܣ�����������
���룺Array  $array ����ǰ������
�����Array  ����������

function sign($prestr,$sign_type)
���ܣ�ǩ���ַ���
���룺String $prestr ��Ҫǩ�����ַ���
      String $sign_type ǩ������
�����String ǩ�����

function log_result($word)
���ܣ�д��־��������ԣ�����վ����Ҳ���Ըĳɴ������ݿ⣩
���룺String $word Ҫд����־����ı�����

function query_timestamp($partner) 
���ܣ����ڷ����㣬���ýӿ�query_timestamp����ȡʱ����Ĵ�����
���룺String $partner ���������ID
�����String ʱ����ַ���

function charset_encode($input,$_output_charset ,$_input_charset)
���ܣ�ʵ�ֶ����ַ����뷽ʽ
���룺String $input ��Ҫ������ַ���
      String $_output_charset ����ı����ʽ
      String $_input_charset ����ı����ʽ
�����String �������ַ���

function charset_decode($input,$_input_charset ,$_output_charset) 
���ܣ�ʵ�ֶ����ַ����뷽ʽ
���룺String $input ��Ҫ������ַ���
      String $_output_charset ����Ľ����ʽ
      String $_input_charset ����Ľ����ʽ
�����String �������ַ���

��������������������������������������������������������������

alipay_notify.php

function alipay_notify($partner,$key,$sign_type,$_input_charset = "GBK",$transport= "https") 
���ܣ����캯��
      �������ļ��г�ʼ������
���룺String $partner ���������ID
      String $key ��ȫУ����
      String $sign_type ǩ������
      String $_input_charset �ַ������ʽ Ĭ��ֵ GBK
      String $transport ����ģʽ Ĭ��ֵ https

function notify_verify()
���ܣ���notify_url����֤
�����Bool  ��֤�����true/false

function return_verify()
���ܣ���return_url����֤
�����Bool  ��֤�����true/false

function get_verify($url,$time_out = "60")
���ܣ���ȡԶ�̷�����ATN���
���룺String $url ָ��URL·����ַ
      String $time_out ��ʱ��ʱ�� Ĭ��ֵ60
�����String ������ATN����ַ���

��������������������������������������������������������������

alipay_service.php

function alipay_service($parameter,$key,$sign_type)
���ܣ����캯��
      �������ļ�������ļ��г�ʼ������
���룺Array  $parameter ��Ҫǩ���Ĳ�������
      Array  $key ��ȫУ����
      Array  $sign_type ǩ������

function build_form()
���ܣ�������ύHTML
�����String ���ύHTML�ı�



��������������������
 ��������������
��������������������

�ڼ����ĵ�����������б����������������������ҵ�������ԭ��Ҫ������Щ��������ô���԰�������Ĳ�������������ӿڹ��ܡ�

�������Բ���it_b_payΪ��������
��alipayto.php�ļ�����ע�͡����²�������Ҫͨ���µ�ʱ�Ķ������ݴ��������á��롰/////////////////////////////////////////////////�������֮��������´��룺

/////////////////////////////////////////////////
//��չ���ܲ��������Զ��峬ʱ(��Ҫʹ�ã��밴��ע��Ҫ��ĸ�ʽ��ֵ)
//�ù���Ĭ�ϲ���ͨ��
//���뿪ͨ��ʽ��
//��ʽһ����ϵ֧��������֧�����봦��
//��ʽ��������0571-88158090����
//��ʽ�����ύ�������루https://b.alipay.com/support/helperApply.htm?action=consultationApply��
$it_b_pay = "";
//��ʱʱ�䣬����Ĭ����15�졣���÷�Χ��1m~15d��,-�ָ�����~-��Χ �� m-���ӣ�h-Сʱ��d-�죬1c-���죨���ۺ�ʱ���������׶���0��رգ�
//�磺$it_b_pay  = "1m~1h,2h,3h,1c";
/////////////////////////////////////////////////


�ڡ�����Ҫ����Ĳ������飬����Ķ���ע���·��ġ��������$parameter������������Ԫ�ء� "it_b_pay"	=> $it_b_pay��


/////////////////////////////////////////////////
$parameter = array(
        "service"		=> "create_direct_pay_by_user",	//�ӿ����ƣ�����Ҫ�޸�
        "payment_type"		=> "1",               			//�������ͣ�����Ҫ�޸�

        //��ȡ�����ļ�(alipay_config.php)�е�ֵ
        "partner"		=> $partner,
        "seller_email"		=> $seller_email,
        "return_url"		=> $return_url,
        "notify_url"		=> $notify_url,
        "_input_charset"	=> $_input_charset,
        "show_url"		=> $show_url,

        //�Ӷ��������ж�̬��ȡ���ı������
        "out_trade_no"		=> $out_trade_no,
        "subject"		=> $subject,
        "body"			=> $body,
        "total_fee"		=> $total_fee,

        //��չ���ܲ�������������ǰ
        "paymethod"		=> $paymethod,
        "defaultbank"		=> $defaultbank,

        //��չ���ܲ�������������
        "anti_phishing_key"	=> $anti_phishing_key,
	"exter_invoke_ip"	=> $exter_invoke_ip,

	//��չ���ܲ��������Զ������
	"buyer_email"		=> $buyer_email,
        "extra_common_param"=> $extra_common_param,
		
	//��չ���ܲ�����������
        "royalty_type"		=> $royalty_type,
        "royalty_parameters"	=> $royalty_parameters,

        //��չ���ܲ��������Զ��峬ʱ
        "it_b_pay"		=> $it_b_pay
);
/////////////////////////////////////////////////


��������������������
 �������⣬��������
��������������������

����ڼ���֧�����ӿ�ʱ�������ʻ�������⣬��ʹ����������ӣ��ύ���롣
https://b.alipay.com/support/helperApply.htm?action=supportHome
���ǻ���ר�ŵļ���֧����ԱΪ������




