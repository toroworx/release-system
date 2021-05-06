<?php
/**
 * @package   AkeebaReleaseSystem
 * @copyright Copyright (c)2010-2021 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @noinspection PhpUnusedAliasInspection */
use Akeeba\Component\ARS\Administrator\Helper\Format;use Akeeba\Component\ARS\Administrator\Helper\Html;use Akeeba\Component\ARS\Administrator\Helper\Select;

/** @var $this \Akeeba\ReleaseSystem\Admin\View\Logs\Html */

defined('_JEXEC') or die;

?>

@jhtml('formbehavior.chosen')

@extends('any:lib_fof40/Common/browse')

@section('browse-filters')
    <div class="akeeba-filter-element akeeba-form-group">
        @searchfilter('itemtext', 'itemtext', 'COM_ARS_LOGS_FIELD_ITEM')
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        @searchfilter('usertext', 'usertext', 'COM_ARS_LOGS_FIELD_USER')
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        @searchfilter('referer', 'referer', 'COM_ARS_LOGS_FIELD_REFERER')
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        @searchfilter('ip', 'ip', 'COM_ARS_LOGS_FIELD_IP')
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        {{ \FOF40\Html\FEFHelper\BrowseView::publishedFilter('authorized', 'COM_ARS_LOGS_FIELD_AUTHORIZED') }}
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        @selectfilter('category', \Akeeba\Component\ARS\Administrator\Helper\Select::categories(), 'COM_ARS_COMMON_CATEGORY_SELECT_LABEL', ['class' => 'advancedSelect'])
    </div>

    <div class="akeeba-filter-element akeeba-form-group">
        @selectfilter('version', \Akeeba\Component\ARS\Administrator\Helper\Select::releases(false), 'COM_ARS_COMMON_RELEASE_SELECT_LABEL', ['class' => 'advancedSelect'])
    </div>
@stop

@section('browse-table-header')
    <tr>
        <th width="32">
            @jhtml('FEFHelp.browse.checkall')
        </th>
        <th>
            @sortgrid('item_id', 'COM_ARS_LOGS_FIELD_ITEM')
        </th>
        <th>
            @sortgrid('user_id', 'COM_ARS_LOGS_FIELD_USER')
            <br />
            @sortgrid('ip', 'COM_ARS_LOGS_FIELD_IP')
        </th>
        <th>
            @sortgrid('accessed_on', 'COM_ARS_LOGS_FIELD_ACCESSED')
            <br /> <span class="akeeba-hidden-mobile">
                @sortgrid('referer', 'COM_ARS_LOGS_FIELD_REFERER')
                <br />
            </span>
        </th>
        <th>
            @sortgrid('authorized', 'COM_ARS_LOGS_FIELD_AUTHORIZED')
        </th>
    </tr>
@stop

@section('browse-table-body-withrecords')
	<?php
	$i = 0;
	/** @var \Akeeba\ReleaseSystem\Admin\Model\Logs $row */
	?>
    @foreach($this->items as $row)
        <tr>
            <td>
                @jhtml('FEFHelp.browse.id', ++$i, $row->getId())
            </td>
            <td>
                <strong>{{{ $row->item->release->category->title }}}</strong>
                <em>{{{ $row->item->release->version }}}</em> <br /> <small>{{{ $row->item->title }}}</small>
            </td>
            <td>
                @include('any:lib_fof40/Common/user_show', ['item' => $row, 'field' => 'user_id', 'ShowID' => false, 'showAvatar' => true, 'avatarSize' => 24, 'showLink' => false])
            </td>
            <td>
                <div class="ars-logs-accessed-on">
                    {{ Format::formatDate($row->accessed_on, true) }}
                </div>
                <div class="ars-logs-ip">
                    {{{ $row->ip }}}
                </div>
                <div class="ars-logs-referer">
                    <span title="{{{ $row->referer }}}" class="hasTooltip">
                        {{{ $row->referer }}}
                    </span>
                </div>
            </td>
            <td>
                @jhtml('FEFHelp.browse.published', $row->authorized, $i, '', false)
            </td>
        </tr>
    @endforeach
@stop
