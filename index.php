<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
?><?$APPLICATION->IncludeComponent("bitrix:news.list", "reviews", Array(
	"IBLOCK_TYPE" => "reviews",	
		"IBLOCK_ID" => "3",	
		"NEWS_COUNT" => "20",	
		"SORT_BY1" => "ACTIVE_FROM",	
		"SORT_ORDER1" => "DESC",	
		"SORT_BY2" => "SORT",	
		"SORT_ORDER2" => "ASC",	
		"FILTER_NAME" => "",	
		"FIELD_CODE" => array(	
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(	
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => ".default",
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
	),
	false
);?>

<h2>Оставить отзыв:</h2>
<form action="" method="post" enctype="multipart/form-data" class="form-rew">
	<input type="text" placeholder="Имя" name="NAME" class="text" style="width:500px;padding:10px;"><br /><br />
	<input type="text" placeholder="Почта" name="EMAIL" class="text" style="width:500px;padding:10px;"><br><br />
	<textarea placeholder="Текст отзыва" name="REVIEWS" class="text-mess" style="width:500px;padding:10px;"></textarea><br><br />
	<input type="submit" class="submit" value="Отправить" name="OK">
</form>

<?
if($_POST["OK"]){
	if(CModule::IncludeModule("iblock")){	
		if($_POST["NAME"]!="" && $_POST["EMAIL"]!="" && $_POST["REVIEWS"]!=""){
			echo "Спасибо за отзыв!";
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(), 
			  "IBLOCK_SECTION_ID" => false,        
			  "IBLOCK_ID"      => 3, 
			  "NAME"           => $_POST["NAME"], 
			  "ACTIVE"         => "Y",         
			  "PREVIEW_TEXT"   => $_POST["REVIEWS"], 
			  "DETAIL_TEXT"    => "E-Mail: " . $_POST["EMAIL"], 
			  "PREVIEW_PICTURE" => CFile::MakeFileArray($fileID)
			  );
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
			  echo "";
			else
			  echo "";   
		}else{
			echo "Заполнены не все поля";
		}
	}
}
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>